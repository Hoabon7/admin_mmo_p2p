<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\CustomerExchange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BackendToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backend:to:admin';
   

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

    public function getCustomerFromExchangeMMO () {

        return $this->customerExchange->get();
    }

    public function insertCustomer($dataCustomer){
        return $this->customerAdmin->insert($dataCustomer);

    }

    public function updateCustomer($dataCustomer){
        return $this->customerAdmin->where('id', $dataCustomer->id)
                            ->update([
                                    'avatar' => $dataCustomer->avatar,
                                    'reason' => $dataCustomer->reason,
                                    'name' => $dataCustomer->name,
                                    'address' => $dataCustomer->address,
                                    'image_bank' => $dataCustomer->image_bank,
                                    'image_idCard' => $dataCustomer->image_idCard,
                                ]);
    }

    public function checkCustomerInAdminMMO ($dataCustomerExchange) {

        
        foreach ($dataCustomerExchange as $key => $customer) {
            
            //if(isset($this->customerAdmin->where('id', $customer->id)->get()[0]->id) == true){
            if($this->customerAdmin->where('id', $customer->id)->first() != null){
                $this->updateCustomer($customer);
            }else{
                $this->insertCustomer(json_decode($customer, true));
            }
           
        }
       
        
    }

    public function handle (){
        Log::info($this->checkCustomerInAdminMMO($this->getCustomerFromExchangeMMO()) );
        
    }
}
