<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>static/style.css">
    <title>PHP | Products</title>
</head>
<body>
    <section>
        <form action="create" method="POST">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <h3>Add a new product</h3>
            <label>Name: <input type="text" name="name" id="name" value="<?= $this->session->userdata('name')?>"></label>
<?php if($this->session->userdata("error_name") != NULL){ echo "".$this->session->userdata("error_name").""; $this->session->unset_userdata("error_name");}?>
            <label>Description: <input type="text" name="description" id="description" value="<?= $this->session->userdata('description')?>"></label>
<?php if($this->session->userdata("error_description") != NULL){ echo "".$this->session->userdata("error_description").""; $this->session->unset_userdata("error_description");}?>
            <label>Price: <input type="text" name="price" id="price" value="<?= $this->session->userdata('price')?>"></label>
<?php if($this->session->userdata("error_price") != NULL){ echo "".$this->session->userdata("error_price").""; $this->session->unset_userdata("error_price");}?>
            <input type="submit" class="create" value="Create">
        </form>
        <h3>Products</h3>
            <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Data Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php       if($products->get()->stored->id != NULL){
                $products->get();
                foreach($products AS $prodduct){ ?>
                    <tr>
                        <td class="name"><?= $prodduct->name ?></td>
                        <td><?= $prodduct->description ?></td>
                        <td class="price">Php <?= $prodduct->price ?></td>
                        <td class="date"><?= DATE("F j Y", STRTOTIME($prodduct->created_at)) ?></td>
                        <td class="action">
                            <a href="products/show/<?= $prodduct->id ?>" class="show">Show</a>
                            <a href="products/edit/<?= $prodduct->id ?>" class="edit">Edit</a>
                            <a href="products/remove/<?= $prodduct->id ?>" class="remove">Remove</a>
                        </td>
                    </tr>
<?php           }
            }
            else{ ?>
                <tr>
                    <td colspan="4">No Data Found</td>
                </tr>
<?php       } ?>
            </tbody>
        </table>
<?php
    $this->session->unset_userdata('name');
    $this->session->unset_userdata('description');
    $this->session->unset_userdata('price');
?>
    </section>
</body>
</html>