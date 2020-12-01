<?php ob_start(); ?>
<!-- <pre> -->
<?php 
// GetSizes(); ?>
<!-- </pre> -->
<div class="sidebar-wrapper sidebar-wrapper-mrg-right">
    <div class="sidebar-widget mb-40">
        <h4 class="sidebar-widget-title">Search</h4>
        <div class="sidebar-search">
            <form class="sidebar-search-form" action="#">
                <input type="text" placeholder="Search here..." />
                <button>
                    <i class="icon-magnifier"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
        <h4 class="sidebar-widget-title">Categories</h4>
        <div class="shop-catigory sidebar-widget-list">
            <ul>
                <?php foreach( $data['cats'] as $cat ): ?>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <a class="ml-0" href="<?php echo URL . 'front/categories?cat_id=' . $cat['id']; ?>">
                                <?php echo $cat['name']; ?>
                                <span><?php echo getCount( 'name', 'categories','id = '.$cat['id'].'' ); ?></span>
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
        <h4 class="sidebar-widget-title">Price Filter</h4>
        <div class="price-filter">
            <span>Range: $100.00 - 1.300.00 </span>
            <div id="slider-range"></div>
            <div class="price-slider-amount">
                <div class="label-input">
                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                </div>
                <button type="button">Filter</button>
            </div>
        </div>
    </div>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
        <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
            <h4 class="sidebar-widget-title">Refine By</h4>
            <div class="sidebar-widget-list">
                <ul>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" name="on_sale" value="1"/> <a href="#">On Sale <span><?php echo getCount( 'id', 'products','sale AND status = "in_stock" ' ); ?></span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" name="new" value="1" /> <a href="#">New <span>5</span></a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" name="in_stock" value="1" /> <a href="#">In Stock <span><?php echo getCount( 'id', 'products','status = "in_stock" ' ); ?></span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
            <h4 class="sidebar-widget-title">Size</h4>
            <div class="sidebar-widget-list">
                <ul>
                    <?php foreach( GetSizes() as $size => $count ): ?>
                        <li>
                            <div class="sidebar-widget-list-left">
                                <input type="checkbox" name="size[]" value="<?php echo $size; ?>" /> <a href="<?php echo URL . 'front/categories?size=' . $size; ?>"><?php echo $size; ?><span><?php echo $count; ?></span> </a>
                                <span class="checkmark"></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
            <h4 class="sidebar-widget-title">Color</h4>
            <div class="sidebar-widget-list">
                <ul>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" value="" /> <a href="#">Green <span>7</span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" value="" /> <a href="#">Cream <span>8</span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" value="" /> <a href="#">Blue <span>9</span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="sidebar-widget-list-left">
                            <input type="checkbox" value="" /> <a href="#">Black <span>3</span> </a>
                            <span class="checkmark"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <button type="submit" class="btn btn-md btn-success mb-5">Filter</button> -->
        <input type="submit" name="filter" class="btn btn-md btn-success mb-5" value="Filter">
    </form>
    <div class="sidebar-widget shop-sidebar-border pt-40">
        <h4 class="sidebar-widget-title">Popular Tags</h4>
        <div class="tag-wrap sidebar-widget-tag">
            <a href="#">Clothing</a>
            <a href="#">Accessories</a>
            <a href="#">For Men</a>
            <a href="#">Women</a>
            <a href="#">Fashion</a>
        </div>
    </div>
</div>
