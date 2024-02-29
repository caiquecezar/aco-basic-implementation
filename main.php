<?php

require_once 'vendor/autoload.php';

use App\Aco\Player;
use App\Aco\Sinergy;
use App\Aco\Team;
use App\Constants\Configs;
use App\Models\Factories\PlayerFactory;
use App\Utils\Benchmark\Benchmark;
use App\Utils\Benchmark\ExecutionTimer;
use App\Utils\Benchmark\Outputs\LogHandler;
use App\Utils\Benchmark\Searchs\AcoSearch;
use App\Utils\Benchmark\Searchs\DefaultSearch;
use App\Utils\Benchmark\Searchs\DummySearch;
use CaiqueCezar\Aco\Components\AntColonyOptimization;
use CaiqueCezar\Aco\Components\Builders\ContextBuilder;

$players = PlayerFactory::create(20);

$nodes = [];
foreach ($players as $player) {
    $nodes[] = new Player($player);
}

$dummySearch = new DummySearch($nodes);
$defaultSearch = new DefaultSearch($nodes);

$ants = 2000;
$pheromone = new Sinergy(10000, 0.01);
$context = ContextBuilder::builder()
    ->addNodesFromArray($nodes)
    ->createPaths($pheromone)
    ->addSolution(Team::class)
    ->build();
$aco = new AntColonyOptimization($context, $ants);

$acoSearch = new AcoSearch($aco);

$runner = new Benchmark([
    Configs::OUTPUT => Configs::OUTPUT_LOG,
    Configs::OUTPUT_FILE_TYPE => Configs::OUTPUT_FILE_TYPE_CSV,
    Configs::EXECUTION_TIMES => 100
]);

$runner->run($defaultSearch);
$runner->withExcutionTimes(1)->run($dummySearch);
$runner->run($acoSearch);
