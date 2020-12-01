       
                </div>
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
                        <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </footer>
                <!-- Footer END -->
        
            </div>
            <!-- Page Container END -->

            <?php
            get_admin_file( 'search' );
            get_admin_file( 'quick_view' );
            ?>

        </div>

    </div>
    
    <!-- Core Vendors JS -->
    <script src="<?php echo get_script( 'dashboard-vendors.min.js' ) ?>"></script>

    <!-- page js -->
    <script src="<?php echo get_script( 'vendors/select2.min.js' ) ?>"></script>
    <script src="<?php echo get_script( 'vendors/quill.min.js' ) ?>"></script>
    <script src="<?php echo get_script( 'vendors/e-commerce-product-edit.js' ) ?>"></script>


    <script src="<?php echo get_script( 'vendors/jquery.dataTables.min.js' ) ?>"></script>
    <script src="<?php echo get_script( 'vendors/dataTables.bootstrap.min.js' ) ?>"></script>
    <script src="<?php echo get_script( 'vendors/datatables.js' ) ?>"></script>
    
    <!-- Core JS -->
    <script src="<?php echo get_script( 'dashboard.min.js' ) ?>"></script>

    <!-- DY content JS -->
    <script src="<?php echo get_script( 'dy-content.js' ) ?>"></script>

</body>

</html>