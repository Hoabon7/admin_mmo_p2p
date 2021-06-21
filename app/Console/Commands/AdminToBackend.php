<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use App\Models\CustomerExchange;
use Illuminate\Support\Facades\Log;

class AdminToBackend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:to:backend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $customerExchange;
    protected $customerAdmin;
    public function __construct(Customer $customerAdmin,CustomerExchange $customerExchange)
    {
        $this->customerAdmin = $customerAdmin;
        $this->customerExchange = $customerExchange;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function getCustomerFromAdminMMO () {

        return $this->customerAdmin->get();
    }

    public function updateCustomer($dataCustomer){
        return $this->customerExchange->where('id', $dataCustomer->id)
                            ->update([
                                    'email' => $dataCustomer->email,
                                    'status' => $dataCustomer->status,
                                    'role' => $dataCustomer->role,
                                    'insurance_money' => $dataCustomer->insurance_money,
                                ]);
    }

    public function checkCustomerInExchangeMMO ($dataCustomerExchange) {

        
        foreach ($dataCustomerExchange as $key => $customer) {
            
            if($this->customerExchange->where('id', $customer->id)->first() != null){
                $this->updateCustomer($customer);
            }
        }
       
        
    }

    public function handle (){
        $this->checkCustomerInExchangeMMO($this->getCustomerFromAdminMMO()) ;
    }
}
