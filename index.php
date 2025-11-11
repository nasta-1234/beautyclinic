<?php

include 'components/connect.php';

if(isset($_COOKIE['id_pelanggan'])){
    $id_pelanggan = $_COOKIE['id_pelanggan'];
}else{
    $id_pelanggan ='';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASTA Self-Love Mevement</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo time();?>">
    <style>
        .quick-access {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .quick-access .btn {
            padding: 10px 20px;
            background-color: #ff66b3;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }
        .quick-access .btn:hover {
            background-color: #ff3399;
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <?php include 'components/user_footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/admin_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
