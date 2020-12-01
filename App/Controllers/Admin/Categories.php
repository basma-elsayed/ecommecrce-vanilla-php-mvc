<?php
/**
 * 
 * Categories Controller
 * 
 */
namespace Controllers\Admin;
use \Models\categorie as catsDB;
use \Models\general as GDB;
class Categories extends \Core\Controller
{

    // public
    public $cats_db;
    public $general_db;

    public function __construct()
    {
        validateUser();
        $this->cats_db = new catsDB();
        $this->general_db = new GDB();
    }

    /**
     * Display all Categories
     * check user permissions to See Categories
     */
    public function all()
    {
        // init $data array
        $data = $this->general_db->get( '*', $this->cats_db->tabel );

        if( empty($data) ){
            $result      = '<h3 class="text-center mt-5">NO Categries Found</h3>';
            $result     .= '<p class="text-center mt-3">
                                <a class="btn btn-md btn-success" href="'.URL.'admin/categories/new">Add new category 
                                    <span>Add new category</span>
                                    <i class="anticon anticon-plus"></i>
                                </a>
                            </p>';
            // Load NO Result view
            $this->views( 'noresult.php', $result );
            return;
        }

        // Load edit view
        $this->views( 'Admin/categories/all.php', $data );
    }

    /**
     * Create new Category
     * check user permissions to create Category
     */
    public function new ()
    {
        // init data array
        $data = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Sanitize inputs
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );
            
            // Collect inputs into one array
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'visbility' => isset( $_POST['visbility'] ) ? 1 : 0,
                'allow_comments' => isset( $_POST['allow_comments'] ) ? 1 : 0,
                'allow_ads' => isset( $_POST['allow_ads'] ) ? 1 : 0,
            ];

            // Errors Counter
            $errors = 0;

            /**
             * Validate the POST values
             * Name && Description must be filled
             * Description length = [ >= 300 ] Characters
             */
            foreach( $data as $input => $value ):
                // empty input
                if( empty($data[$input]) ):
                    $data[$input. '_err'] = ucwords($input). ' can`t be empty';
                    $errors++;
                else:
                    switch( $input ):
                        // Category name already token
                        case 'name':
                            if( $this->general_db->IsExists( 'name', $this->cats_db->tabel, '', $data['name'] ) ){
                                $data[$input.'_err'] = ucwords($input).' exists, Please choose another one';
                                $errors++;
                            }else{
                                $data[$input.'_success'] = 'Looks Good!';
                            }
                        break;

                        // Validate description
                        case 'description':
                            if( strlen( $data['description'] ) >= 300 ) {
                                $data['description_err'] = ucwords($input).' must be under 300 Characters';
                                $errors++;
                            }else{
                                $data['description_success'] = 'Looks Good!';
                            }
                        break;

                    endswitch;
                endif;
            endforeach;

            // IF Errors Counter === 0
            if( $errors === 0 ):

                /**
                 * Insert new category
                 * On Success:
                 * Store flash success msg
                 * Redirect to display Categories page
                 * On Failure:
                 * Flash error msg
                 */
                if( $this->cats_db->insert( $data ) ){
                    // flash success msg
                    flash( 'category_action', 'Category '.$data['name'].' add successfully!', 'success' );
                    // redirect to display Categories page
                    redirect( 'admin/categories/all' );
                }else{
                    flash( 'category_action', 'Error has occured, please try later', 'danger' );
                }
            endif;

        }
        // Load edit view
        $this->views( 'Admin/categories/new.php', $data );
    }

    /**
     * Edit exists Category
     * check user permissions to edit Category
     */
    public function edit($parmas)
    {   
        $cats = $this->general_db->IsExists( '*', $this->cats_db->tabel, 'id', $parmas['cat_id'], 'ASSOC' );
        
        // No Cayegory has that id
        if( ! $cats || ! isset($parmas['cat_id']) ) {
            // Warning msg
            flash( 'category_actions', 'NO Category found', 'danger' );
            // redirect back
            redirect('admin/categories/all');
        }

        // If form is submitted
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Sanitize inputs
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );

            // Collect inputs into one array
            $post = [
                'id'                => $parmas['cat_id'],
                'name'              => trim($_POST['name']),
                'description'       => trim($_POST['description']),
                'ordering'          => isset( $_POST['ordering'] ) ? 1 : 0,
                'visiblity'         => isset( $_POST['visiblity'] ) ? 1 : 0,
                'allow_comments'    => isset( $_POST['allow_comments'] ) ? 1 : 0,
                'allow_ads'         => isset( $_POST['allow_ads'] ) ? 1 : 0,
                'permission'        => isset( $_POST['permission'] ) ? $_POST['permission'] : '',
                'password'          => isset( $_POST['password'] ) ? $_POST['password'] : '',
            ];

            /**
             * Validate only the field that has changed
             * 1- Compare POST values to $cats values
             * 2- Store chaged keys and values into $diff array
             * 3- Validate the field(s) which user has changed and update it 
             */ 

            // Compare two arrays values
            $diffs = [];
            foreach( $post as $key => $value ){
                if( $cats[$key] != $value ){
                    $diffs[$key] = $value;
                }
            }
            
            // User has update field(s)
            $updated = ( count($diffs) > 0 ) ? true : false;
            // Output msg [ Profile has nothing changed ]
            if( ! $updated ){
                flash( 'category_actions' , 'Category has nothing changed' , 'warning text-center' );
            }else{

                $errors = 0;
                if( $updated ):

                    foreach( $diffs as $input => $value  ):
                        // if empty
                        if( isset( $post[$input] ) && empty( $post[$input] ) && ! is_int($post[$input]) ):
                            $cats[$input . '_err'] = ucwords($input) . ' Can`t be empty ';
                            $cats[$input] = $post[$input];
                            $errors++;
                        else:
                            
                            switch( $input ):

                                // Category name exists
                                case 'name':
                                    if( $this->general_db->exists( 'name', $this->cats_db->tabel, ' WHERE name = "'.$post['name'].'"' ) ){
                                        $cats[$input.'_err'] = ucwords($input) .' already exists';
                                        $cats[$input] = $post[$input];
                                        $errors++;
                                    }else{
                                        $cats[$input.'_success'] = 'Looks Good';
                                        $cats[$input] = $post[$input];
                                    }
                                break;

                                // Validate description
                                case 'description':
                                    if( strlen( $post['description'] ) > 300 ) {
                                        $cats[$input . '_err'] = ucwords($input) . ' must be under 300 Characters';
                                        $cats[$input] = $post[$input];
                                        $errors++;
                                    }
                                    else{
                                        $post['description_success'] = 'Looks Good!';
                                        $cats[$input] = $post[$input];
                                    }
                                break;

                                // Validate visiblity
                                case 'visiblity':
                                    $cats[$input] = $post[$input];
                                break;

                                // Validate allow_comments
                                case 'allow_comments':
                                    $cats[$input] = $post[$input];
                                break;

                                // Validate allow_ads
                                case 'allow_ads':
                                    $cats[$input] = $post[$input];
                                break;

                            endswitch;

                        endif;

                    endforeach;

                endif;

                //  update the changed values
                if( $errors === 0 ){

                    /**
                     * Update values
                     * On Success:
                     * Redirect to All Categories page 
                     * Flash Success msg
                     * On Failure:
                     * Flash Faild msg
                     */
                    if( $this->cats_db->update( $post, $parmas['cat_id'] ) ){
                        // falsh success msg
                        flash( 'category_actions', 'Category '.$data['cat_name'].' updated successfully', 'success' );
                        // Redirect to update page
                        redirect('admin/categories/all');
                    }else{
                        flash( 'category_actions', 'Update Category has been Faild, try again later', 'danger' );
                    }
                }

            }

        }
        // Load edit view
        $this->views( 'Admin/categories/edit.php', $cats );
    }


    /**
     * Delete exists Category
     * check user permissions to delete Category
     */
    public function delete($parmas)
    {   
        $cats = $this->general_db->IsExists( '*', $this->cats_db->tabel, 'id', $parmas['cat_id'], 'ASSOC' );

        // Category exist
        if( ! $cats || ! isset($parmas['cat_id']) ){
            // Warning msg
            flash( 'category_actions', 'NO Category found', 'danger' );
            // redirect back
            redirect('admin/categories/all');
        }

        if( $this->general_db->remove( $this->cats_db->tabel, ' WHERE id = '.intval($parmas['cat_id']).'') ) {
            // falsh success msg
            flash( 'category_actions', 'Category <strong>'.$cats['name'].'</strong> Deleted successfully', 'success' );
            // Redirect to update page
            redirect('admin/categories/all');
        }else{
            flash( 'category_actions', 'Failed to Delete the Category, Please try agin later', 'danger' );
            // Redirect to update page
            redirect('admin/categories/all');
        } 
    }

}