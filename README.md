# orion-api-php
Orion api php sdk

## Пример использования

1. Получение списка реализаций и их состава.

```php
    require __DIR__ . '/vendor/autoload.php';
    
    $token = 'token';
    $clienId = 000;

    $ordersClient = new \Orion\Clients\OrdersClient($clienId, $token);
    $ordersClient->setPeriod(30);
    $listOrders = $ordersClient->getListOrder();
    $orders = $listOrders->getOrders()->getAll();
    foreach($orders as $key => $order){
        $realId = $order->getRealId();
        $orderClient = new \Orion\Clients\OrderClient($clienId, $token);
        $orderClient->setRealId($realId);        
        $orderData = $orderClient->getOrderData();
        $items = $orderData->getItems()->getAll();
        foreach($items as $ikey => $item){
            echo '['.$item->getProductId().' : '.$item->getProductQty().' - '.$item->getProductCost().']';
            echo '<br>';
        }
    }
```

2. Получение характеристик товаров

```php
    // ...
    $productId = 000;   
    $productClient = new \Orion\Clients\ProductClient($clienId, $token);
    $productClient->addProductId($productId);
    $response = $productClient->getProductsResponse();
    $products = $response->geProducts()->getAll();
    foreach($products as $key => $product) {
        $properties = $product->geProperties()->getAll();
        foreach($properties as $pkey => $property) {
            echo '['.$property->getGroup().' : '.$property->getName().' - '.$property->getValue().']';
            echo '<br>';
        }
    }
```

2. Создание нового заказа

```php
    // ...
    $productId = 000;
    $count = 1;
    $newOrder = new \Orion\Clients\NewOrderClient($clienId, $token);
    $item = new \Orion\Models\NewOrderItem(array('productId' => $productId, 'count' => $count));
    $newOrder->setComments('text comment')->addItem($item);
    $newOrder->setDateTime(new DateTime('2019-11-26T15:00:00'));
    $order = $newOrder->getOrderData();
    $orderId = $order->getOrderId();
    $dateShipment = $order->getDateShipment();
    echo '('.$orderId.' - '.$dateShipment.')<br>';
    $products = $order->getProducts()->getAll();
    foreach($products as $key => $product) {
        echo '('.
        $product->getProductId().' - '.
        $product->getProductQty().' - '.
        $product->getProductCost().')<br>';
    }
```

2. Подтверждение товаров в заказе

```php
    // ...
    $confirmOrder = new \Orion\Clients\ConfirmOrderClient($clienId, $token);
    $confirmOrder->setRealId('s0000000000');
    $item = new \Orion\Models\NewOrderItem(array('productId' => 000, 'count' => 1, 'price' => 100, 'wishPrice' => 99));
    $confirmOrder->addItem($item);
    $confirmData = $confirmOrder->confirmOrder();
    echo '('.$confirmData->getRealId().')';
```