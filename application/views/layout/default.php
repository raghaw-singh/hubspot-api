<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title_for_layout; ?></title>
    <script type="text/javascript">
        var base_url                =   '<?= base_url();?>';
    </script>

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css');?>" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/datatables/jquery.dataTables.min.css');?>"/>  
    <script type="text/javascript" src="<?= base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>

    <?php $this->load->view('layout/header');?>
    <div class="container mt-5">
        <?php echo $content_for_layout; ?>
    </div>
    <?php $this->load->view('layout/footer');?>
</div><!-- //wrap -->

</body>
</html>