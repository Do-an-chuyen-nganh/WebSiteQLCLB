
<div class="col-lg-4">
    <div class="blog_right_sidebar">
        <aside class="single_sidebar_widget search_widget">
            <form action="#">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder='Tìm kiếm' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                        <div class="input-group-append">
                            <button class="btns" type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Tìm kiếm</button>
            </form>
        </aside>
        <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title" style="color: #2d2d2d;">Danh sách CLB</h4>
            <ul class="list cat-list">
                <?php
                $show_club = $clb->show_club();
                if ($show_club) {
                    $i = 0;
                    while ($result = $show_club->fetch_assoc()) {
                        $i++;
                        $count = $event->show_event_byCLB($result['clb_id']);


                ?>
                        <li>
                            <a href="news_clb.php?clb_id=<?php echo $result['clb_id']?>" class="d-flex">
                                <p><?php echo $result['clbName'] ?></p>
                                <p> (<?php echo $count[0][0] ?>)</p>
                            </a>
                        </li>

                <?php
                    }
                }
                ?>
            </ul>
        </aside>

        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title" style="color: #2d2d2d;">Sự kiện gần đây</h3>
            <?php
                $listEvent = $event->show_event(1,0);
                for ($i=0; $i < sizeof($listEvent); $i++) { 

            ?>
            <div class="media post_item">
                <img src="../uploads/<?php echo $listEvent[$i][7] ?>" alt="post" width="70" height="70">
                <div class="media-body">
                    <a href="detail.php?id=<?php echo $listEvent[$i][0]?>">
                        <h3 style="color: #2d2d2d;"><?php echo $listEvent[$i][1] ?></h3>
                    </a>
                    <p><?php echo $listEvent[$i][3] ?></p>
                </div>
            </div>
            <?php
                }
            ?>

        </aside>

        <aside class="single_sidebar_widget newsletter_widget">
            <h4 class="widget_title" style="color: #2d2d2d;">Đăng ký tham gia</h4>
            <form action="#">
                <div class="form-group">
                    <input type="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Subscribe</button>
            </form>
        </aside>
    </div>
</div>