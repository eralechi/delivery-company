<?php

require_once './vendor/autoload.php';

use \Pagerfanta\Adapter\ArrayAdapter;
use \Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap5View;
use Pagerfanta\View\OptionableView;

$dateFrom = isset($_REQUEST['date_from']) ? $_REQUEST['date_from'] : '';
$dateTo = isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : '';

$deliveries = \Service\DeliveryController::getDeliveries($dateFrom, $dateTo);
$adapter = new ArrayAdapter($deliveries);
$pagerfanta = new Pagerfanta($adapter,  );
if (isset($_GET["page"])) {
    $pagerfanta->setCurrentPage($_GET["page"]);
}
$routeGenerator = static function (int $page) use($dateFrom, $dateTo) : string{
    return  '/?page=' . $page . ($dateFrom ? '&date_from=' . $dateFrom : '') . ($dateTo ? '&date_to=' . $dateTo : '');
};
$defaultView = new TwitterBootstrap5View();
$myView1 = new OptionableView($defaultView, ['proximity' => 5]);
$deliveries = $pagerfanta->getCurrentPageResults();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/js/app.js"></script>
</head>
<body>

    <div class="container">

        <h1>Поездки курьеров</h1>

        <form action="" autocomplete="off">
            Дата поездки c <input type="date" name="date_from" value="<?=$dateFrom?>"> 
            по <input type="date" name="date_to" value="<?=$dateTo?>">
            <button class="btn btn-primary">Применить</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-delivery-modal">Добавить поездку</button>
        </form>
        <br>

        <?php
        if (empty($deliveries)) :?>
            <p>Поездок курьеров не найдено</p>
        <?php else :?>

            <table class="table">
                <tr>
                    <th>Курьер</th>
                    <th>Регион</th>
                    <th>Дата отправки</th>
                    <th>Дата возвращения</th>
                </tr>

                <?php
                foreach ($deliveries as $delivery) :?>
                    <tr>
                        <td><?=$delivery['courier']?></td>
                        <td><?=$delivery['region']?></td>
                        <td><?=date("d.m.Y", strtotime($delivery['depart_date']))?></td>
                        <td><?=date("d.m.Y", strtotime($delivery['return_date']))?></td>
                    </tr>
                <?php endforeach;?>
                
            </table>
            
            <?=$myView1->render($pagerfanta, $routeGenerator);?>

        <?php endif; ?>
    </div>

    <?php
    $courers = \Service\Courier::getCouriers();
    $regions = \Service\Region::getRegions();
    ?>
    <!-- Modal -->
    <div class="modal fade" id="add-delivery-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить поездку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" role="alert" style="display: none;"></div>
                        <div class="alert alert-success" role="alert" style="display: none;"></div>

                        <div class="form-group">
                            <label for="region-selector">Регион:</label>
                            <select name="region" require class="form-control" id="region-selector">
                                <?php
                                foreach ($regions as $region) :?>
                                    <option value="<?=$region->id?>"><?=$region->name?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date-selector">Дата выезда из Москвы:</label>
                            <input type="date" require name="date" class="form-control" id="date-selector">
                        </div>

                        <div class="form-group">
                            <label for="courer-selector">ФИО курьера:</label>
                            <select name="courer" require class="form-control" id="courer-selector">
                                <?php
                                foreach ($courers as $courer) :?>
                                    <option value="<?=$courer->id?>"><?=$courer->fio?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Дата прибытия в регион: <span id="region-arrival-date"></span></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>