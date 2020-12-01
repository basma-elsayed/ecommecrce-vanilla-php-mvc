<?php
/**
 * Display all Catogries
 */
get_admin_file("header");
?>
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-6 mx-auto">
                <?php flash( 'category_actions' ); ?>
            </div>
                <div class="col-8">
                    <h3>Manage Categories</h3>
                    <p>All Exist Categories</p>
                </div>
                <div class="col-4">
                    <a  href="<?php echo URL; ?>admin/categories/new" 
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
                            <th>visiblity</th>
                            <th>Comments</th>
                            <th>Ads</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach( $data as $cat ):
                                ?>
                                <tr>
                                    <td> <?php echo $cat->name; ?> </td>
                                    <td> <?php echo excerpt( $cat->description ); ?> </td>
                                    <td> <?php echo ( $cat->visiblity ) ? 'Visible' : 'Not Visible'; ?> </td>
                                    <td> <?php echo ( $cat->allow_comments ) ? 'Active' : 'Not Active'; ?> </td>
                                    <td> <?php echo ($cat->allow_ads) ? 'Active' : 'Not Active' ; ?> </td>
                                    <td>
                                        <span class="d-lg-inline-block">
                                            <a  href="<?php echo URL; ?>admin/categories/edit?cat_id=<?php echo $cat->id; ?>&cat_name=<?php echo $cat->name; ?>" 
                                                class="d-lg-inline-block btn btn-md btn-primary mb-1 mb-lg-0 mt-3 m-lg-0 m-r-5">
                                                <i class="anticon anticon-edit"></i>   
                                                <span>Edit</span>   
                                            </a>
                                        </span>

                                        <span class="d-lg-inline-block">
                                            <a  href="<?php echo URL; ?>admin/categories/delete?cat_id=<?php echo $cat->id; ?>&cat_name=<?php echo $cat->name; ?>" 
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
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>visiblity</th>
                            <th>Allow Comments</th>
                            <th>Allow Ads</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php
get_admin_file("footer");