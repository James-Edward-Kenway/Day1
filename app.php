<?php

// To autoload prepared functionalities


include_once './includes/autoload.php';


$cmd = new CommandLine();

try {

    // check if there is $orders
    if (count($orders) == 0) {
        $cmd->writeLine("No Data was found on the system!");
        die();
    }

    $cmd->writeLine("Please choose order: [0-" . (count($orders) - 1) . ']');

    // push options
    foreach ($orders as $k => $order) {
        $cmd->writeLine("[" . $k . "] ID: " . $order->id . " Price: " . $order->price);
    }

    // repeat the command unless valid option is entered!
    orders_repeat:

    $key = $cmd->readLine();

    if (@$orders[$key] == null) {
        $cmd->writeLine("Please choose a key in the reange !!!");
        goto orders_repeat;
    }

    $order = @$orders[$key];

    // find the client for the order!
    $client = @(array_filter($clients, function($item) use ($order) {
        return $item->id == $order->client_id;
    }))[0];


    $cmd->writeLine("Please choose communication type: [0-1]");

    // comunication options: email and phone
    $cmd->writeLine("[0] Phone: " . @$client->phone);
    $cmd->writeLine("[1] Email: " . @$client->email);

    comm_rep:

    $key = $cmd->readLine();

    if (!in_array($key, ["0", "1"])) {
        $cmd->writeLine("Please choose a key in the range!!!");
        goto comm_rep;
    }

    $cmd->writeLine("Thank you! you have chosen\n");

    $cmd->writeLine(['Sending Client a notification by Phone', 'Sending Client a notification by Email'][$key]);

    throw new Exception("We are sooo sorry! This app is not connected to any Service to be able to send the client a message");

} catch (\Exception $e) {
    $cmd->error($e->getMessage());
}