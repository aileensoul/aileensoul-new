<div class="page-sidebar-wrapper">    <!-- END SIDEBAR -->    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->    <div class="page-sidebar navbar-collapse collapse">        <!-- BEGIN SIDEBAR MENU -->        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">  



            <!--dashboard --> 
            <li <?php if ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/dashboard' ?>" class="nav-link nav-toggle">           
                    <i class="fa fa-tachometer"></i>                    <span class="title">Dashboard</span>                    <span class="selected"></span>       
                    <span class="arrow open"></span>        
                </a>         
            </li>









            <!--order management -->

            <li <?php if ($this->uri->segment(2) == 'order' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/order' ?>" class="nav-link nav-toggle">                    <i class="icon-home"></i>                    <span class="title">Order management</span>                    <span class="selected"></span>                    <span class="arrow open"></span>             
                </a>       
            </li>

            <!--- order management end --->

            <!-- category start-->   

<!--            <li <?php if ($this->uri->segment(2) == 'category' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/category' ?>" class="nav-link nav-toggle">
                    <i class="fa fa-sort"></i>                    <span class="title">Category management</span>                   <span class="selected"></span>                    <span class="arrow open"></span>                </a>            </li>

            -->


            <li <?php if ($this->uri->segment(2) == 'category' || $this->uri->segment(2) == 'category' || $this->uri->segment(2) == 'customer_report') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                
                <a href="javascript:;" class="nav-link nav-toggle">                    
                    <i class="fa fa-sort" aria-hidden="true"></i>
                    <span class="title">Category </span>
                    <span class="selected"></span>       
                    <span class="arrow open"></span>         
                </a>           

                <ul class="sub-menu">                 

                    <li class="nav-item">                    
                        <a href="<?php echo base_url() . 'admin/category' ?>" class="nav-link nav-toggle">                            <i class="fa fa-sort"></i> 
                            Main Category                            <span class="arrow"></span>                        
                        </a>                    
                    </li>



                    <li class="nav-item">                     
                        <a href="<?php echo base_url() . 'admin/subcategory' ?>" class="nav-link nav-toggle">       <i class="fa fa-sort"></i> Sub Category  <span class="arrow"></span> 
                        </a>                    
                    </li>  


                </ul>          
            </li>

            <!-- category end-->  


            <!-- product start-->                   


            <li <?php if ($this->uri->segment(2) == 'item' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/item' ?>" class="nav-link nav-toggle"> <i class="fa fa-adjust"></i>                    <span class="title">Item management</span>                                        <span class="selected"></span>                    <span class="arrow open"></span>             
                </a>         
            </li>                        


            <!-- product end-->



            <!-- addon product start-->                   


            <li <?php if ($this->uri->segment(2) == 'addon' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/addon' ?>" class="nav-link nav-toggle"> <i class="fa fa-adjust"></i>                    <span class="title"> Addon item management</span>                                        <span class="selected"></span>                    <span class="arrow open"></span>             
                </a>         
            </li>                        


            <!-- addon product end-->




            <!-- table -->

            <li <?php if ($this->uri->segment(2) == 'table' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/table' ?>" class="nav-link nav-toggle">                    <i class="fa fa-table"></i>                    <span class="title">Table management</span>                    <span class="selected"></span>                    <span class="arrow open"></span>             

                </a>         

            </li>

            <!-- table -->

            <!-- employee  start-->

            <li <?php if ($this->uri->segment(2) == 'employer' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >      <a href="<?php echo base_url() . 'admin/employer' ?>" class="nav-link nav-toggle">                    <i class="fa fa-male"></i>                    <span class="title">Employer management</span>                    <span class="selected"></span>                    <span class="arrow open"></span>         
                </a>          
            </li>

            <!-- employee  end-->

            <!-- user start-->

            <li <?php if ($this->uri->segment(2) == 'user' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="<?php echo base_url() . 'admin/user' ?>" class="nav-link nav-toggle">                    <i class="fa fa-users"></i>                    <span class="title">User management</span>                    <span class="selected"></span>                    <span class="arrow open"></span>             

                </a>         

            </li>

            <!-- user end-->


            <!-- employee  start-->

            <li <?php if ($this->uri->segment(2) == 'section' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >      <a href="<?php echo base_url() . 'admin/section' ?>" class="nav-link nav-toggle">                    <i class="fa fa-male"></i>                    <span class="title">Section management</span>                    <span class="selected"></span>                    <span class="arrow open"></span>         
                </a>          
            </li>

            <!-- employee  end-->





            <!-- pages start-->     

 <!--  <li <?php if ($this->uri->segment(2) == 'pages' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >               
   <a <?php if ($this->uri->segment(2) == 'pages' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo base_url() . 'admin/pages' ?>" class="nav-link nav-toggle"> <i class="fa fa-file"></i>               
        <span class="title">Pages management</span>          
           <span class="selected"></span>                  
             <span class="arrow open"></span>            
     </a>

 </li>  -->

            <!--- pages end-->    


            <!-- email templlet start-->                  
            <li <?php if ($this->uri->segment(2) == 'email' || $this->uri->segment(1) == '') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a <?php if ($this->uri->segment(2) == 'email' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo base_url() . 'admin/email' ?>" class="nav-link nav-toggle"> 
                    <i class="fa fa-envelope"></i>                    <span class="title">email Template</span>                   <span class="selected"></span>                    <span class="arrow open"></span>                </a></li>  <!--- email templlet end-->       

            <!--- report start-->    

            <li <?php if ($this->uri->segment(2) == 'reports' || $this->uri->segment(2) == 'sales_report' || $this->uri->segment(2) == 'customer_report') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                
                <a href="javascript:;" class="nav-link nav-toggle">                    
                    <i class="fa fa-flag" aria-hidden="true"></i>
                    <span class="title">Reports </span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>           
                <ul class="sub-menu">                 
                    <li class="nav-item">                    
                        <a href="<?php echo base_url() . 'admin/reports/sales_report' ?>" class="nav-link nav-toggle">                            <i class="fa fa-flag"></i> 
                            Sales Report                            <span class="arrow"></span>                        
                        </a>                    
                    </li>
                    <li class="nav-item">                     
                        <a href="<?php echo base_url() . 'admin/reports/customer_report' ?>" class="nav-link nav-toggle">       <i class="fa fa-flag"></i> Customer Registration Report  <span class="arrow"></span> 
                        </a>                    
                    </li>  
                    <li class="nav-item">                    
                        <a href="<?php echo base_url() . 'admin/reports/employer_sales_report' ?>" class="nav-link nav-toggle">                            <i class="fa fa-flag"></i> 
                            Employer Sales Report   <span class="arrow"></span>                        
                        </a>                    
                    </li>
                    <li class="nav-item">                     
                        <a href="<?php echo base_url() . 'admin/reports/customer_order_item_report' ?>" class="nav-link nav-toggle">       <i class="fa fa-flag"></i> 
                            Customer Order Item Report  <span class="arrow"></span> 
                        </a>                    
                    </li>  

                </ul>          
            </li>


            <!--- report end-->

            <!--- settings start-->    

            <li <?php if ($this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'email_settings' || $this->uri->segment(2) == 'profile') { ?> class= "nav-item start active open" <?php } else { ?> class="nav-item""   <?php } ?> >                <a href="javascript:;" class="nav-link nav-toggle">                    <i class="fa fa-cog"></i>                    <span class="title">Settings </span>                    <span class="selected"></span>                    <span class="arrow open"></span>                </a>           

                <ul class="sub-menu">                 

                    <li class="nav-item">                    
                        <a href="<?php echo base_url() . 'admin/settings' ?>" class="nav-link nav-toggle">                            <i class="icon-settings"></i> Site settings                            <span class="arrow"></span>                        </a>                    </li>



                    <li class="nav-item">                     
                        <a href="<?php echo base_url() . 'admin/email_settings' ?>" class="nav-link nav-toggle">                            <i class="icon-settings"></i> Email settings                            <span class="arrow"></span>                        </a>                    </li>  




                    <li class="nav-item">                     
                        <a href="<?php echo base_url() . 'admin/profile' ?>" class="nav-link nav-toggle">                            <i class="icon-settings"></i> Account settings                            <span class="arrow"></span>   
                        </a>                
                    </li>      
                </ul>          
            </li>


            <!--- settings end-->



        </ul>        <!-- END SIDEBAR MENU -->    </div>    <!-- END SIDEBAR --></div>

<!-- END SIDEBAR -->