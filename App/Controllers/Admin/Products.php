<?php
/**
 * 
 * Products Controller
 * [ CRUD Operations ]
 * 
 */
namespace Controllers\Admin;
use Models\user;
use Models\product;
use Models\general as GDB;
use Classes\Uploader;
use DateTime;
class Products extends \Core\Controller
{
    public $prodcutsModel;

    public function __construct()
    {
        validateUser();
        $this->general_db = new GDB();
        $this->product_db = new product();
    }

    /**
     * Create new product
     * check user permissions to create product
     */
    public function new()
    {
        // Get all Categories
        $cats = $this->general_db->get( '*', 'categories' );
        
        // Init empty data array
        $data = [];

        // Init POST data array
        $data['post'] = [];
        
        // Add categories array to data array
        $data['cats'] = $cats;

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Sanitize POST values
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );

            // Collect POST values into one array
            $data['post'] = [
                'name'          => trim($_POST['name']),
                'description'   => trim($_POST['description']),
                'price'         => trim($_POST['price']),
                'sale_price'    => trim($_POST['sale_price']),
                'category'      => isset($_POST['category']) ? $_POST['category'] : '',
                'brand'         => trim($_POST['brand']),
                'status'        => trim($_POST['status']),
                'size'          => ! empty($_POST['size']) ? serialize($_POST['size']) : ''
            ];

            // Product Image
            $product_img    = $_FILES['product_single_image'];
            $uploader       = Uploader::UplaodeSingleImage( $product_img, $data['post'] );
            $data['post']   = $uploader['data'];
            $errors         = $uploader['errors'];

            // Product gallery Images
            $productGallery                 = Uploader::UplaodeMultipleImage($_FILES['product_gallery'], $data['post']);
            $data['post']                   = $productGallery['data'];
            $data['post']['gallery_arr']    = $productGallery['gallery_arr'];
            $data['post']['gallery']        = $productGallery['gallery'];
            $errors                         += $productGallery['errors'];

            // Optional Fields
            $optional_fields = [ 'sale_price', 'gallery' ];

            // Validate inputs
            foreach( $data['post'] as $input => $value ):
                if( empty( $data['post'][$input] ) && ! in_array( $input, $optional_fields )):
                    $data['post'][$input.'_err'] = str_replace( '_', ' ', ucwords($input) ) . ' Can`t be empty';
                    $errors++;
                else:
                    switch( $input ):
                        
                        // Validate description
                        case 'description':
                            if( strlen($data['post']['description'] ) >= 300 ) {
                                $data['post']['description_err'] = ucwords($input).' must be under 300 Characters';
                                $errors++;
                            }else{
                                $data['post']['description_success'] = 'Looks Good!';
                            }
                        break;

                    endswitch;
                    
                endif;

            endforeach;

            // If is Okay
            if( $errors === 0 ):

                if( $this->product_db->insert( $data['post'] , $_SESSION['id'] ) ){

                    // image path
                    $img_path = IMGS . 'products/';
                    Uploader::CompleteUploadingProccess( $img_path );
                    Uploader::CompleteUploadingGalleryProccess($data['post']['gallery_arr'], $img_path);
                    // Insert Products into tabel products
                    // set flash msg
                    flash( 'products_actions', 'Prodcut <strong>'. $data['post']['name'] .'</strong> was addedd successfully!', 'success' );
                    // Redirect to display products page
                    redirect( 'admin/products/all' );

                }else{
                    flash( 'products_actions', 'Failed to add Prodcut: <strong>'. $data['post']['name'] .'</strong>, Please try later.', 'danger' );
                }
            endif;

        }
        // Load new product view
        $this->Views( 'Admin/products/new.php', $data );
    }

    /**
     * Display all Products
     * check user permissions to See products
     */
    public function all ()
    {
        // Get all products
        $data = $this->product_db->get('ASSOC');

        // unserialize serialized array
        foreach( $data as $key => $value ):
            $data[$key]['size'] = unserialize($data[$key]['size']);
        endforeach;

        // If no products
        if( empty($data) ){
            $result      = '<h3 class="text-center mt-5">NO Products Found</h3>';
            $result     .= '<p class="text-center mt-3">
                                <a class="btn btn-md btn-success" href="'.URL.'admin/products/new">
                                    <span>Add new Product</span>
                                    <i class="anticon anticon-plus"></i>
                                </a>
                            </p>';
            // Load NO Result view
            $this->Views( 'noresult.php', $result );
            return;
        }

        // Load all products view
        $this->Views( 'Admin/products/all.php', $data );
    }

    /**
     * Edit Exists Products
     * check user permissions to edit products
     */
    public function edit ($parmas)
    {
        $product = $this->general_db->get( '*', $this->product_db->tabel, 'WHERE id = '. $parmas['item_id'] .'', 'ASSOC', true );
        
        // No Product has that id || item_id does not exist in the query
        if( ! $product || ! isset($parmas['item_id']) ) {
            // Warning msg
            flash( 'products_actions', 'NO Product Found', 'danger' );
            // redirect back
            redirect('admin/products/all');
        }
        
        // Get Categries id, name
        $cats = $this->general_db->get( 'id, name', 'categories', '', 'ASSOC');
        
        // Init Data array
        $data = [];
        
        // Add products to data array
        $data['product'] = $product;

        // Add categories to data array
        $data['cats'] = $cats;

        // init $_POST values holder array
        $data['post'] = [];

        // Init product record to unserialize
        $serialized_arr = [ 'size', 'gallery' ];

        // unserialize serialized product array item
        for( $i = 0; $i < count( $serialized_arr ); $i++ ):
            $data['product'][$serialized_arr[$i]] = unserialize($data['product'][$serialized_arr[$i]]);
        endfor;

        // Format product create date
        $date = new DateTime($product['date']);
        $data['product']['date'] = $date->format('d-m-Y');

        // If form is submitted
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Sanitize inputs
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );

            // Collect inputs into one array
            $data['post'] = [
                'id'                => $parmas['item_id'],
                'name'              => trim($_POST['name']),
                'description'       => trim($_POST['description']),
                'price'             => trim($_POST['price']),
                'sale'              => trim($_POST['sale']),
                'status'            => trim($_POST['status']),
                'cat_id'            => trim($_POST['category']),
                'size'              => $_POST['size'] ? $_POST['size'] : '',
                'brand'             => trim($_POST['brand']),
                'image'             => $_FILES['new_single_primg'],
                'gallery'           => $_FILES['new_gallery_primg']
            ];

            /**
             * Validate only the field that has changed
             * 1- Compare POST values to $product values
             * 2- Store chaged keys and values into $diff array
             * 3- Validate the field(s) which user has changed and update it 
             */

            // $optional_fields
            $optional_fields = [ 'sale', 'image', 'gallery' ];

            /**
             * Compare POST values to $product values
             * Get the fields that has changed
             */
            $diffs = [];
            foreach( $data['post'] as $key => $value ){
                if( $data['product'][$key] !== $value ){
                    $diffs[$key] = $value;
                }
            }

            // User has update field(s)
            $updated = ( count($diffs) > 0 ) ? true : false;

            // Output msg [ Profile has nothing changed ]
            if( ! $updated ){
                flash( 'products_actions' , 'Product has nothing changed' , 'warning text-center' );
            }else{

                // Errors Counter
                $errors = 0;
                if( $updated ):
                    foreach( $diffs as $input => $value  ):
                        // if empty
                        if( empty( $diffs[$input] ) && ! in_array( $input, $optional_fields ) ):
                            $data['post'][$input . '_err'] = ucwords($input) . ' Can`t be empty ';
                            $errors++;
                        else:
                            
                            switch( $input ):

                                // Validate description
                                case 'description':
                                    if( strlen( $data['post']['description'] ) > 300 ) {
                                        $data['post'][$input . '_err'] = ucwords($input) . ' must be under 300 Characters';
                                        $errors++;
                                    }
                                break;

                                // Validate single image
                                case 'image':
                                    if( $_FILES['new_single_primg']['error'] === 0 ):
                                        $uplaoder = Uploader::UplaodeSingleImage( $_FILES['new_single_primg'], $data['post'] );
                                        $data['post'] = $uplaoder['data'];
                                        $errors += $uplaoder['errors'];
                                    endif;
                                break;
                                // Validate Gallery
                                case 'gallery':
                                    if( $_FILES['new_gallery_primg']['error'][0] === 0 ):
                                        // Update Gallery
                                        $GalleryUplaoder = Uploader::UplaodeMultipleImage($_FILES['new_gallery_primg'], $data['post']);
                                        $data['post']                   = $GalleryUplaoder['data'];
                                        $data['post']['gallery']        = $GalleryUplaoder['gallery'];
                                        $errors                         += $GalleryUplaoder['errors'];
                                        $gallery_arr                    = $GalleryUplaoder['gallery_arr'];
                                    endif;
                                break;
                            endswitch;

                        endif;

                        // Update product matched key values
                        if( $input !== 'image' && $input !== 'gallery' ) $data['product'][$input] = $data['post'][$input];
                    endforeach;
                endif;

                //  update the changed values
                if( $errors === 0 ){

                    /**
                     * Update values
                     * On Success:
                     * Redirect to All Products page 
                     * Flash Success msg
                     * On Failure:
                     * Flash Faild msg
                     */
                    $data['post']['old_img'] = $data['product']['image'];
                    
                    $gallery_updated = true;
                    // Check if gallery update
                    if( array_key_exists( 'name', $data['post']['gallery'] ) ){
                        // user dose not update the gallery
                        // gallery === old gallery
                        $data['post']['gallery'] = $data['product']['gallery'];
                        $gallery_updated = false;
                    }
            
                    if( $this->product_db->update( $data['post'], $parmas['item_id'] ) ){

                        // Update single img
                        if( ! empty($data['post']['img']) ){
                            // Imgs Path 
                            $img_path = IMGS . 'products/';

                            // Delete old images
                            Uploader::DeleteImage($img_path . $data['product']['image']);

                            // uplaod new images
                            Uploader::CompleteUploadingProccess( $img_path );
                        }

                        // Update Gallery img
                        if( $gallery_updated ){
                            // Imgs Path 
                            $img_path = IMGS . 'products/';

                            // Delete old images
                            Uploader::DeleteGallery($data['product']['gallery'], $img_path);

                            // uplaod new images
                            Uploader::CompleteUploadingGalleryProccess($gallery_arr, $img_path );
                        }

                        // falsh success msg
                        flash( 'products_actions', 'Product '.$data['post']['name'].' updated successfully', 'success' );
                        // Redirect to update page
                        redirect('admin/products/all');
                    }else{
                        flash( 'products_actions', 'Update Category has been Faild, try again later', 'danger' );
                    }
                }

            }
        }

        // Load Edit products view
        $this->Views( 'Admin/products/edit.php', $data );
    }

    /**
     * Delete Exists Products
     * check user permissions to Delete products
     */
    function delete($parmas)
    {
        $product = $this->general_db->IsExists( 'id, image, gallery', $this->product_db->tabel, 'id', $parmas['item_id'], 'ASSOC' );

        // Category exist
        if( ! $product || ! isset($parmas['item_id']) ){
            // Warning msg
            flash( 'products_actions', 'NO Products Found', 'danger' );
            // redirect back
            redirect('admin/products/all');
        }

        if( $this->general_db->remove( $this->product_db->tabel, ' WHERE id = '.intval($parmas['item_id']).'') ) {
            // Delete Product image
            $path = IMGS . 'products/' ;
            Uploader::DeleteImage($path. $product['image']);

            // Delete Product Gallery if exists image
            if( ! is_null($product['gallery']) ){
                $product['gallery'] = unserialize($product['gallery']);
                Uploader::DeleteGallery($product['gallery'], $path);
            }
            // falsh success msg
            flash( 'products_actions', 'Product <strong>'.$product['name'].'</strong> Deleted successfully', 'success' );
            // Redirect to update page
            redirect('admin/products/all');
        }else{
            flash( 'products_actions', 'Failed to Delete the Product <strong>'.$product['name'].'</strong> , Please try agin later', 'danger' );
            // Redirect to update page
            redirect('admin/products/all');
        }
    }

}