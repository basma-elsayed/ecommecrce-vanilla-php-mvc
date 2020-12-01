<?php
/**
 * Display all products
 */
get_admin_file("header");
?>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <?php echo flash( 'products_actions' ); ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                
                <div class="col-8">
                    <h3>Manage Products</h3>
                    <p>All Exist Products</p>
                </div>
                <div class="col-4">
                    <a  href="<?php echo URL; ?>admin/products/new" 
                        class="d-lg-inline-block btn btn-md btn-secondary float-right">
                        <i class="anticon anticon-plus"></i>  
                        <span>Add New</span>   
                    </a>
                </div>
            </div>
            <div class="m-t-25">
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach( $data as $product ): ?>
                                
                                <tr>
                                    <td> <?php echo $product['name']; ?> </td>
                                    <td> <?php echo excerpt( $product['description'] ); ?> </td>
                                    <td> <?php echo $product['price']; ?> </td>
                                    <td> <?php echo ! is_null($product['sale']) ? $product['sale'] : 'out of sale'; ?> </td>
                                    <td> <?php echo $product['cat_name']; ?> </td>
                                    <td> <?php echo $product['author_name']; ?> </td>
                                    <td> <?php echo $product['brand']; ?> </td>
                                    <td> <?php echo $product['status']; ?> </td>
                                    <td> 
                                        <?php 
                                        for( $i = 0;  $i < count($product['size']); $i++ ): 
                                            $glue = $i < ( count($product['size']) -1 ) ? ' , ' : '';
                                        ?>
                                            <span> <?php echo $product['size'][$i] . $glue; ?> </span>
                                        <?php endfor; ?>
                                    </td>
                                    <td>
                                        <span class="d-lg-inline-block">
                                            <a  href="<?php echo URL; ?>/admin/products/edit?item_id=<?php echo $product['id']; ?>" 
                                                class="d-lg-inline-block btn btn-md btn-primary mb-1 mb-lg-0 mt-3 m-lg-0 m-r-5">
                                                <i class="anticon anticon-edit"></i>   
                                                <span>Edit</span>   
                                            </a>
                                        </span>

                                        <span class="d-lg-inline-block">
                                            <a  href="<?php echo URL; ?>admin/products/delete?item_id=<?php echo $product['id']; ?>" 
                                                class="btn btn-md btn-danger mt-3 m-lg-0 m-r-5">
                                                <i class="anticon anticon-close"></i>   
                                                <span>Delete</span>
                                            </a>
                                        </span>

                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Size</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

<?php
get_admin_file('footer');