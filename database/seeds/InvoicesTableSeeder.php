<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = App\Location::inRandomOrder()->get();

        $invoicesPerLocation = $this->command->ask('How many Invoices would you like for every location?', 10);

        $invoicesPerLocation = intval($invoicesPerLocation) ?? 10;

        if ($locations->isNotEmpty()) {
            $locations->each(function ($location) use ($locations, $invoicesPerLocation) {
                $invoices = [];

                $origin_id = $location->id;
                for ($invoiceCount = 0; $invoiceCount < $invoicesPerLocation; $invoiceCount++) {
                    $invoice = factory('App\Invoice')->make(
                        [
                            'destination_id' => $locations->random()->id,
                        ]
                    )->toArray();

                    array_forget($invoice, 'cost_per_unit');

                    array_push($invoices, $invoice);
                }

                $location->invoicesFrom()->createMany($invoices);
            });
        }

        $invoicesCount = App\Invoice::count();
        $this->command->line(sprintf('There are %d Invoices in system now.', $invoicesCount));
    }
}
