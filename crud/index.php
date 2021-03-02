<?php

require_once ("../crud/php/component.php");
require_once ("../crud/php/operation.php");


error_reporting(E_ERROR | E_PARSE);
?>
<?php

$mysqli = mysqli_connect('localhost', 'root', '', 'library');
$columns = array('book_name','book_isbn','book_publisher','book_price','book_category');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $mysqli->query('SELECT * FROM books ORDER BY ' .  $column . ' ' . $sort_order)) {
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Custom stylesheet-->
    <link rel="stylesheet" href="style.css">


</head>
<body>
      <main>
        <div class="container justify-content-center text-center">
            <h1 class="py-4 bg-dark  text-light my-0 "><i class="fa fa-book-reader">Library</i></h1>

            <div class="d-flex justify-content-center  bg-warning my-0 ">
                <form action="" method="post" class="w-50">
                    <div class="py-2 pt-2">
                        <?php inputElement("<i class='fa fa-book'></i>","Name","book_name","" );?>

                    </div>
                    <div class="pt-2">

                        <?php inputElement("<i class='fa fa-qrcode'></i>","ISBN","book_isbn","" );?>
                    </div>

                    <div class="row pt-2">

                        <div class="col">
                           <?php inputElement("<i class='fa fa-user-circle'></i>","Publisher","book_publisher","" );?>
                        </div>

                        <div class="col">
                            <?php inputElement("<i class='fa fa-euro-sign'></i>","Price","book_price","" );?>

                        </div>

                    </div>
                    <div class="form-group">


                        <select class="form-control" name="book_category" >
                            <option value="choose">Choose your category</option>
                            <option value="Romance">Romance</option>
                            <option value="Horror">Horror</option>
                            <option value="Drama">Drama</option>
                            <option value="Drama">Detective</option>
                            <option value="Drama">Mystery</option>
                            <option value="Drama">Fantasy</option>

                        </select>


                    </div>
                    <div class="d-flex justify-content-center">
                        <?php buttonElement("btn-create","btn-success","<i class='fas fa-plus'></i>","create","data-toggle='tooltip'
                        data-placement='bottom' title='Create' "); ?>
                        <?php buttonElement("btn-read","btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip'
                        data-placement='bottom' title='Read' "); ?>

                    </div>
                </form>


            </div>

            <!--Bootstrap table-->

            <div class="table-data">

                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>Book Name</th>
                            <th>ISBN</th>
                            <th>Publisher</th>
                            <th><a href="index.php?column=book_price&order=<?php echo $asc_or_desc; ?>">Book Price<i class="fas fa-sort<?php echo $column == 'book_price' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                            <th>Book Category</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        if(isset($_POST['read'])){
                            $result=getData();
                        }
                        if($result){
                            while($row=mysqli_fetch_assoc($result)){
                                ?>
                                <tr>

                                    <td<?php echo $column == 'book_name' ? $add_class : ''; ?>><?php echo $row['book_name']; ?></td>
                                    <td<?php echo $column == 'book_isbn' ? $add_class : ''; ?>><?php echo $row['book_isbn']; ?></td>
                                    <td<?php echo $column == 'book_publisher' ? $add_class : ''; ?>><?php echo $row['book_publisher']; ?></td>
                                    <td<?php echo $column == 'book_price' ? $add_class : ''; ?>><?php echo $row['book_price']; ?></td>
                                    <td<?php echo $column == 'book_category' ? $add_class : ''; ?>><?php echo $row['book_category']; ?></td>

                                </tr>



                        <?php
                            }
                        }
                        ?>

                    </tbody>

                </table>

            </div>

          </div>
      </main>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>