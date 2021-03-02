<?php

require_once ("db.php");
require_once ("component.php");

$con= Createdb();

//create button click

if(isset($_POST['create'])){
    createData();
}



function createData(){


    $bookname=textboxValue("book_name");
    $bookisbn=textboxValue("book_isbn");
    $bookpublisher=textboxValue("book_publisher");
    $bookprice=textboxValue("book_price");
    $bookcategory=textboxValue("book_category");




    if($bookname && $bookisbn && $bookpublisher &&  $bookprice && $bookcategory){
        $sql="INSERT INTO books(book_name,book_isbn,book_publisher,book_price,book_category)
                VALUES('$bookname','$bookisbn','$bookpublisher','$bookprice','$bookcategory')
                ";
        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success","Record is saved");

        }
        else{
            echo "Error";
        }

    }else{
            TextNode("error","Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox=mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }
    else {
        return $textbox;
    }
}

//messages

function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//get data from mysql database

function getData(){
    $sql = "SELECT * FROM books";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}