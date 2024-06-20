<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FetchRandomUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-random-users {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch random users from the API and store in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');

        $response = Http::get('https://randomuser.me/api/?results='.$count); 
        $users = $response->json()['results'];
        
		try{

            foreach ($users as $userData) {
                $user= new User();
            
                $user->username = $userData['login']['username'];
                $user->gender = $userData['gender'];
                $user->name = $userData['name']['first'] . ' ' . $userData['name']['last'];
                $user->country = $userData['location']['country'];
                $user->state = $userData['location']['state'];
                $user->city = $userData['location']['city'];
                $user->address = $userData['location']['street']['number'] . ' ' . $userData['location']['street']['name'];
                $user->email = $userData['email'];
                $user->password = Hash::make($userData['login']['password']);

                if($user->save()){
                    $this->info('User created. Email:'.$user->email.' Password:'.$userData['login']['password']);
                }
                
                $this->info('Successfully fetched and stored random users');
            }

        }catch(Exception $e){
            $response = response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }
    }
}
