<?php

use Illuminate\Database\Seeder;
use App\Attachment;
use App\Comment;
use App\Coupon;
use App\Option;
use App\OptionRole;
use App\OptionType;
use App\OptionVar;
use App\Request;
use App\Transaction;
use App\User;
use App\Role;
class DatabaseSeeder extends Seeder
{
    public $options = [
        'اکوکاردیوگرافی (24ساعته)',
        'Ct-scan',
        'MRI( 24ساعته)',
        'کنتراست رادیولوژی',
        'اولتراسونوگرافی',
        'رادیولوژی'
    ];

    public $vars = [
        'تک کارشناس',
        'دو کارشناس'
    ];
    
    public $types = [
        'طلایی*(2ساعته)',
        'نقره ای*(12ساعته)',
        'برنزی*(24ساعته)'
    ];

    public $coupons = [
        'free' => [
            'type' => 'percent',
            'dis' => 100
        ],
        'half' => [
            'type' => 'percent',
            'dis' => 50
        ],
        'toman' => [
            'type' => 'static',
            'dis' => 10000
        ]
    ];

    public $roles = [
        'add-option' => 'superadmin,admin',
        'edit-option' => 'superadmin,admin',
        'delete-option' => 'superadmin,admin',

        'add-option-var' => 'superadmin,admin',
        'edit-option-var' => 'superadmin,admin',
        'delete-option-var' => 'superadmin,admin',

        'add-option-type' => 'superadmin,admin',
        'edit-option-type' => 'superadmin,admin',
        'delete-option-type' => 'superadmin,admin',

        'add-user' => 'superadmin,admin',
        'edit-user' => 'superadmin,admin',
        'delete-user' => 'superadmin,admin',

        'see-request' => 'superadmin,admin,expert_one,expert_two',
        'add-request' => 'superadmin,admin,expert_one,expert_two,customer',
        'edit-request' => 'superadmin,admin,expert_one,expert_two,customer',
        'delete-request' => 'superadmin,admin',

        'see-attachment' => 'superadmin,admin',
        'add-attachment' => 'superadmin,admin,expert_one,expert_two,customer',
        'edit-attachment' => 'superadmin,admin',
        'delete-attachment' => 'superadmin,admin',

        'add-coupon' => 'superadmin,admin',
        'edit-coupon' => 'superadmin,admin',
        'delete-coupon' => 'superadmin,admin',

        'add-comment' => 'superadmin,admin,expert_one,expert_two',
        'edit-comment' => 'superadmin,admin,expert_one,expert_two',
        'delete-comment' => 'superadmin,admin',
        
        'add-transaction' => 'superadmin,admin',
        'edit-transaction' => 'superadmin,admin',
        'delete-transaction' => 'superadmin,admin',

        
    ];

    public $optionsId = [];
    public $varsId = [];
    public $typesId = [];
    public $transactionsId = [];
    public $transactionsIdS = []; // sucesss transaction
    public $requestsId = [];

    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 40)->create();

        $user = User::find(1);
        $user->email = "mohammad13yazdani@gmail.com";
        $user->role = "superadmin";
        $user->save();
        
        $this->options();
        $this->vars();
        $this->types();
        $this->optionRole();
        $this->coupons();
        $this->transactions();
        $this->requests();
        $this->attachments();
        $this->roles();

    }

    public function options(){
        foreach($this->options as $val){
            $obj = new Option();
            $obj->name = $val;
            $obj->save();
            $this->optionsId[] = $obj->id;
        }
    }
    public function vars(){
        foreach($this->optionsId as $id){
            foreach($this->vars as $val){
                $obj = new OptionVar();
                $obj->option_id = $id;
                $obj->name = $val;
                $obj->price = rand(1000, 99999);
                $obj->save();
                $this->varsId[] = $obj->id;
            }
        }
    }
    public function types(){
        foreach($this->optionsId as $id){
            foreach($this->types as $val){
                $obj = new OptionType();
                $obj->option_id = $id;
                $obj->name = $val;
                $obj->save();
                $this->typesId[] = $obj->id;
            }
        }
    }
    public function optionRole(){
        $counter = 1;
        foreach([15,12,10,12,2,2] as $role){
            $obj = new OptionRole();
            $obj->option_id = $counter;
            $obj->role_key = "attachment_count";
            $obj->role_value = $role;
        }

        $counter = 1;
        foreach(['300','300','300','300','300','300'] as $role){
            $obj = new OptionRole();
            $obj->option_id = $counter;
            $obj->role_key = "attachment_size";
            $obj->role_value = $role;
        }
    }
    public function coupons(){
        foreach($this->coupons as $key => $val){
            $obj = new Coupon();
            $obj->code = $key;
            $obj->discount = $val['dis'];
            $obj->discount_type = $val['type'];
            $obj->save();
        }
    }

    public function transactions(){
            for($i = 1; $i <= 30; $i++){
                $obj = new Transaction();
                $obj->name = "CASE";
                $obj->user_id = rand(1, 4);
                $obj->option_var_id = arr_rand($this->varsId);
                $obj->option_type_id = arr_rand($this->typesId);
                $obj->price = rand(0, 1000);
                $obj->coupon = rand(0, 3);
                $obj->authority_code = rand(1000000, 9999999 );
                $obj->status = rand(0, 1);
                $obj->save();
                $this->transactionsId[] = $obj->id;
                if($obj->status == 1){
                    $this->transactionsIdS[] = $obj->id;
                }
                
            }
    }

    public function requests(){
        foreach($this->transactionsIdS as $val){
            $faker = \Faker\Factory::create();
            $obj = new Request();
            $obj->transactions_id = $val;
            $obj->title = $faker->title;
            $obj->content = $faker->paragraph;
            $obj->status = arr_rand(['new', 'mark', 'hold', 'comment', 'finish']);
            $obj->save();

            // set attachment to meta_data table
            for($n = 0; $n <= rand(2, 20); $n++){
                $obj->setMeta('attachment', rand(1,20));
            }
            $this->requestsId = $obj->id;
        }
    }

    public function attachments(){
        for($n = 0; $n <= 40; $n++){
            $obj = new Attachment();
            $obj->src = "/uploads/" . date('Y') . "/" . date('m') . "/" . $n . ".jpg";
            $obj->save();
        }
    }
    public function roles(){
        foreach($this->roles as $key => $value){
            $obj = new Role();
            $obj->option = $key;
            $obj->access_role_name = $value;
            $obj->save();
        }
    }

}
