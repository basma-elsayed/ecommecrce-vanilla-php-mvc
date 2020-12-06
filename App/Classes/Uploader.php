<?php
/**
 * Uploader
 * Rules to Upload [ Image | File ]
 */
namespace Classes;
class Uploader
{
    // errors counter
    static $errors = 0;
    static $err_holder;
    static $default_exts = [ 'jpeg', 'jpg', 'png' ];
    static $img_ext;
    static $img_arr;
    static $img_name;
    static $data;
    static $gallery;
    static $galleryErrors = 0;
    static $gallery_arr = [];
    /**
     * Uplaod Single image
     * 
     */
    public static function UplaodeSingleImage( $img_arr, $err_holder )
    {
        self::$err_holder   = $err_holder;
        self::$img_arr      = $img_arr;
        // User Uplaoded an image
        if( $img_arr['error'] === 0 ){
                
            // Validate exts
            $img_name = explode( ".", strtolower( self::$img_arr['name'] ));
            self::$img_ext = end($img_name);
            if( ! in_array( self::$img_ext,  self::$default_exts ) ){
                self::$err_holder['img_err'] = 'Not allowed image extention, Please upload extions like [ jpeg, jpg, png ]';
                self::$errors++;
            }

            // Validate size
            if( empty(self::$err_holder['img_err']) && self::$img_arr['size'] > ( 1024*1024 ) ){
                self::$err_holder['img_err'] = 'Image size too big, Please upload image under 1MB';
                self::$errors++;
            }

            // Create Random image name
            if( self::$errors === 0 ) self::$img_name = self::RandomImageName();
        }
        elseif( self::$img_arr['error'] === 4 ){
            self::$err_holder['img_err'] = 'Please Uplaod Product image';
            self::$errors++;
        }

        return [
            'data' => self::$err_holder,
            'errors' => self::$errors,
        ];
    }

    /**
     * Create random image name with prefix [ primg_ ]
     */
    public static function RandomImageName()
    {
        $new_img_name = uniqid('primg_') . '.' . self::$img_ext;
        self::$err_holder['img'] = $new_img_name;
        return $new_img_name;
    }

    /**
     * Move to Specified images path
     */
    public static function CompleteUploadingProccess($path)
    {
        // image path
        $path   = $path . self::$img_name;
        $tmp    = self::$img_arr['tmp_name'];
        // Move to prodcut images path
        move_uploaded_file( $tmp, $path );
    }

    /**
     * Move to Specified images path
     * @param array $gallery contains name && tmp_name
     * @param string $path path to products dir
     */
    public static function CompleteUploadingGalleryProccess(array $gallery, string $path)
    {

        for ($i= 0; $i < count($gallery) ; $i++) { 
            // image path
            $img_path   = $path . $gallery[$i]['name'];
            $tmp        = $gallery[$i]['tmp'];
            // Move to prodcut images path
            move_uploaded_file( $tmp, $img_path );
        }
    }



    /**
     * Uplaod Multiple images
     * 
     */
    public function UplaodeMultipleImage($gallery, $data)
    {
        self::$data                 = $data;
        self::$gallery              = $gallery;
        $product_gallery            = [];

        // Loop through Gallery
        for ($i = 0; $i < count($gallery['error']); $i++): 
            
            // Check for each image`s error
            if( $gallery['error'][$i] === 0 ):

                // Validate Image exts
                $img_name = explode( ".", strtolower( $gallery['name'][$i] ));
                self::$img_ext = end($img_name);
                if( ! in_array( self::$img_ext,  self::$default_exts ) ){
                    self::$data['gellery_ext_err'][$i] = 'Not allowed image extention for '. $gallery['name'][$i] .', Please upload extions like [ jpeg, jpg, png ]';
                    self::$galleryErrors++;
                }

                // Validate size
                if( empty(self::$data['gellery_ext_err'][$i]) && self::$gallery['size'][$i] > ( 1024*1024 ) ){
                    self::$data['gallery_size_err'][$i] = 'Image size too big for '. $gallery['name'][$i] .', Please upload image under 1MB';
                    self::$galleryErrors++;
                }

                // Create Random image name
                if( self::$galleryErrors === 0 ) {

                    self::$gallery_arr[] = [
                        'name' => self::RandomImageName(),
                        'tmp' => $gallery['tmp_name'][$i]
                    ];

                    $product_gallery[] = self::$gallery_arr[$i]['name'];
                }
            
            endif;

        endfor;

        return [
            'data'          => self::$data,
            'errors'        => self::$galleryErrors,
            'gallery_arr'   => self::$gallery_arr,
            'gallery'       => $product_gallery,
        ];
    }

    /**
     * Delete Exist image
     */
    public static function DeleteImage($image_path)
    {
        // Image already exists
        if( file_exists($image_path)){
            unlink($image_path);
        }
    }

    /**
     * Delete Exist image
     * @param array $gallery contains exist gallery images name
     */
    public static function DeleteGallery($gallery, $path)
    {
        // Image already exists
        for( $i = 0; $i < count($gallery); $i++ ){
            if( file_exists($path . $gallery[$i])){
                unlink($path . $gallery[$i]);
            }
        }
        
    }


}