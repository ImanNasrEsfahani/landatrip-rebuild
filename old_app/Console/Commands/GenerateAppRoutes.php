<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class GenerateAppRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:app-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $allRoutes = collect(Route::getRoutes());
//
//        $routes = $allRoutes->filter(function ($item) {
//            return (in_array("api", explode("/", $item->uri()), true) && in_array("user-panel", explode("/", $item->uri()), true)) || $item->getName() === "logout" || $item->getName() === "login" || $item->getName() === "profile.show";
//        })->map(function ($route) {
//            return [
//                'uri' => $route->uri(),
//                'name' => $route->getName(),
////                'middleware' => $route->gatherMiddleware(),
////                'action' => $route->getActionName(),
//            ];
//        })->keyBy("name");
//
////        $routes->toJson(JSON_OBJECT_AS_ARRAY);
//        $objected = collect(["routes" => $routes]);
//        Storage::disk("resource")->put('js/user-panel/routes.json', $objected);
//
//        $this->info('User Panel React Routes collection file generated successfully.');
        return Command::SUCCESS;
    }
}
