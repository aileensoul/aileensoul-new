<!--header start-->

<header class="header black-bg">

    <div class="sidebar-toggle-box">

        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>

    </div>

    <!--logo start-->

    <h2 class="logo"><b>Admin Panel</b></h2>

    <!--logo end-->

    <div class="nav notify-row" id="top_menu">

        <!--  notification start -->

        <ul class="nav top-menu">

            <!-- settings start -->

<!--            <li id="header_inbox_bar" class="dropdown">

                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">

                    <i class="fa fa-tasks"></i>

                    <span class="badge bg-theme"><?php echo $message_notification_count; ?></span>

                </a>

                <ul class="dropdown-menu extended inbox">

                    <div class="notify-arrow notify-arrow-green"></div>

                    <li>

                        <p class="green">You have <?php echo $message_notification_count; ?> new messages</p>

                    </li>

                    <?php

                    foreach ($message_notification as $notification) {

                        

                        ?>

                        <li>

                            <a href="<?php echo base_url('message/read_message/'.$notification['not_from'].'/'.$notification['not_from_id']); ?>">

                                <?php

                                if ($notification['not_from'] == 1) {

                                    if ($notification['message_from'] == 1 && $notification['message_from_id'] == 1) {

                                        ?>

                                        <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/profile/thumbs/' . $notification['user_image'] ?>"></span>

                                        <?php

                                    } else {

                                        ?>

                                        <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/users/thumbs/' . $notification['user_image'] ?>"></span>

                                        <?php

                                    }

                                } elseif ($notification['not_from'] == 2) {

                                    ?>

                                    <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/company/thumbs/' . $notification['user_image'] ?>"></span>

                                    <?php

                                } elseif ($notification['not_from'] == 3) {

                                    ?>

                                    <span class="photo"><img src="<?php echo base_url() . '../uploads/client/thumbs/' . $notification['user_image'] ?>" alt="<?php echo $notification['user_name'] ?>"></span>

                                    <?php

                                }

                                ?>



                                <span class="subject">

                                    <?php

                                    if ($notification['not_from'] == 1) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    } elseif ($notification['not_from'] == 2) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    } elseif ($notification['not_from'] == 3) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    }

                                    ?>

                                    <span class="time"><?php echo $notification['message_create_date'] ?></span>

                                </span>

                                <span class="message">

                                    <?php echo $notification['message'] ?>

                                </span>

                            </a>

                        </li>

                        <?php

                    }

                    ?>

                    <li>

                        <a href="<?php echo base_url('message'); ?>">See all messages</a>

                    </li>

                </ul>

            </li>  -->

           <!--  settings end -->

            <!-- inbox dropdown start -->

            <li id="header_inbox_bar" class="dropdown">

                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">

                    <i class="fa fa-envelope-o"></i>

                    <?php

                    if($message_notification_count != 0)

                    {

                    ?>

                    <span class="badge bg-theme"><?php echo $message_notification_count; ?></span>

                    <?php

                    }

                    ?>

                </a>

                <ul class="dropdown-menu extended inbox">

                    <div class="notify-arrow notify-arrow-green"></div>

                    <li>

                        <p class="green">You have <?php echo $message_notification_count; ?> new messages</p>

                    </li>

                    <?php

                    foreach ($message_notification as $notification) {

                        

                        ?>

                        <li>

                            <a href="<?php echo base_url('message/read_message/'.$notification['not_from'].'/'.$notification['not_from_id']); ?>">

                                <?php

                                if ($notification['not_from'] == 1) {

                                    if ($notification['message_from'] == 1 && $notification['message_from_id'] == 1) {

                                        ?>

                                        <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/profile/thumbs/' . $notification['user_image'] ?>"></span>

                                        <?php

                                    } else {

                                        ?>

                                        <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/users/thumbs/' . $notification['user_image'] ?>"></span>

                                        <?php

                                    }

                                } elseif ($notification['not_from'] == 2) {

                                    ?>

                                    <span class="photo"><img alt="<?php echo $notification['user_name'] ?>" src="<?php echo base_url() . '../uploads/company/thumbs/' . $notification['user_image'] ?>"></span>

                                    <?php

                                } elseif ($notification['not_from'] == 3) {

                                    ?>

                                    <span class="photo"><img src="<?php echo base_url() . '../uploads/client/thumbs/' . $notification['user_image'] ?>" alt="<?php echo $notification['user_name'] ?>"></span>

                                    <?php

                                }

                                ?>



                                <span class="subject">

                                    <?php

                                    if ($notification['not_from'] == 1) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    } elseif ($notification['not_from'] == 2) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    } elseif ($notification['not_from'] == 3) {

                                        ?>

                                        <span class="from"><?php echo $notification['user_name'] ?></span>

                                        <?php

                                    }

                                    ?>

                                    <span class="time"><?php echo $notification['message_create_date'] ?></span>

                                </span>

                                <span class="message">

                                    <?php echo $notification['message'] ?>

                                </span>

                            </a>

                        </li>

                        <?php

                    }

                    ?>

                    <li>

                        <a href="<?php echo base_url('message'); ?>">See all messages</a>

                    </li>

                </ul>

            </li>  

            <!-- inbox dropdown end -->

        </ul>

        <!--  notification end -->

    </div>

    <div class="top-menu">

        <ul class="nav pull-right top-menu">

            <li><a class="logout" href="<?php echo base_url('login/logout') ?>">Logout</a></li>

        </ul>

    </div>

</header>

<!--header end-->

