<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FbrService;

class TestFbrScenarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fbr:test-scenarios 
                            {--validate : Only validate scenarios without posting}
                            {--post : Post all scenarios to Sandbox}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run and transmit all required FBR Sandbox test scenarios to unlock the Production Security Token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $validateOnly = $this->option('validate');
        $action = $validateOnly ? 'Validating' : 'Posting';
        $scenarios = FbrService::getAllSandboxScenarios();
        $totalCount = count($scenarios);

        $this->info("==========================================================================");
        $this->info(" FBR DIGITAL INVOICING - {$totalCount} SCENARIOS TEST RUNNER ({$action})");
        $this->info("==========================================================================");

        $seller = FbrService::getSellerDetails();
        $this->line("Seller NTN:      <comment>{$seller['sellerNTNCNIC']}</comment>");
        $this->line("Business Nature: <comment>{$seller['businessNature']}</comment>");
        $this->line("Sector:          <comment>{$seller['sector']}</comment>");
        $this->line("Seller Name:     <comment>{$seller['sellerBusinessName']}</comment>");
        $this->line("Endpoint:        <comment>" . ($validateOnly ? FbrService::getValidateUrl() : FbrService::getPostUrl()) . "</comment>");
        $this->newLine();

        $this->info("Executing {$totalCount} scenarios against FBR Gateway...");
        $bar = $this->output->createProgressBar($totalCount);
        $bar->start();

        $res = FbrService::runAllSandboxScenarios($validateOnly);
        $bar->finish();
        $this->newLine(2);

        $tableRows = [];
        $i = 1;
        foreach ($res['scenarios'] as $scId => $item) {
            $statusStr = $item['is_success'] 
                ? "<info>SUCCESS (Valid)</info>" 
                : "<error>FAILED (" . ($item['error'] ?: $item['status']) . ")</error>";

            $tableRows[] = [
                $i++,
                $scId,
                $item['title'],
                $item['rate'],
                $item['sale_type'],
                $item['sro'] ?: '-',
                $item['fbr_invoice_no'] ?: '-',
                $statusStr
            ];
        }

        $this->table(
            ['#', 'Scenario ID', 'Scenario Title', 'Rate', 'Sale Type', 'SRO/Schedule', 'FBR Invoice #', 'Status'],
            $tableRows
        );

        $this->newLine();
        if ($res['is_all_pass']) {
            $this->info("==========================================================================");
            $this->info(" ALL {$res['total']} SCENARIOS PASSED SUCCESSFULLY ({$res['successful']}/{$res['total']})!");
            $this->info(" Your FBR Sandbox environment is fully certified.");
            $this->info(" You can now generate your Production Security Token on the FBR Portal.");
            $this->info("==========================================================================");
            return Command::SUCCESS;
        } else {
            $this->warn("==========================================================================");
            $this->warn(" RESULTS: {$res['successful']} passed, {$res['failed']} failed.");
            $this->warn("==========================================================================");
            return Command::FAILURE;
        }
    }
}
