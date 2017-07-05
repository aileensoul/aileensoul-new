<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

    
	
 	function sendEmail($app_name = '', $app_email = '', $to_email = '', $subject = '', $mail_body = '', $cc = '', $bcc = '') {

//echo "hi"; die();
         //Loading E-mail Class
         $this->load->library('email');

         $emailsetting = $this->common->select_data_by_condition('email_settings', array(), '*');
        //echo '<pre>';        print_r($emailsetting); die();
         $mail_html = '<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
	<title>Confirmed, you’re on the Twist beta waitlist!</title>
	
        <style type="text/css">

            html,
            body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
            }

            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }

            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

             table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }

            img {
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
                border: 0;
                max-width: 100%;
                height: auto;
                vertical-align: middle;
            }

            .yshortcuts a {
                border-bottom: none !important;
            }

            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            @media screen and (min-width: 600px) {
                .ios-responsive-grid {
                    display: -webkit-box !important;
                    display: flex !important;
                }
                .ios-responsive-grid__unit  {
                    float: left;
                }
            }

            

        </style>

     
        <style type="text/css">

            .button__td,
            .button__a {
                transition: all 100ms ease;
            }

            .button__td:hover,
            .button__a:hover {
                background: #1ab77b !important;
            }

            @media screen and (max-width: 599px) {

            
.tw-card { padding: 20px !important; }
.tw-h1 { font-size: 22px !important; }


               .mobile-hidden {
                    display: none !important;
                }

                .mobile-d-block {
                    display: block !important;
                }

                 .mobile-w-full {
                    width: 100% !important;
                }

                 .mobile-m-h-auto {
                    margin: 0 auto !important;
                }

                .mobile-p-0 {
                    padding: 0 !important;
                }

                .mobile-p-t-0 {
                    padding-top: 0 !important;
                }

                .mobile-img-fluid {
                    max-width: 100% !important;
                    width: 100% !important;
                    height: auto !important;
                }
            }

        </style>
    </head>
	<body style="background: #ffffff; height: 100% !important; margin: 0 auto !important; padding: 0 !important; width: 100% !important; ;">
		
		<table cellpadding="0" cellspacing="0" style="background: #f2f2f2; border: 0; border-radius: 0; width: 100%;">
			<tbody>
				<tr>
					<td align="center" class="" style="padding: 0 20px;">
						<table cellpadding="0" cellspacing="0" style="background: #f2f2f2; border: 0; border-radius: 0;">
							<tbody>
								<tr>
									<td align="center" class="" style="width: 600px;">
										<table cellpadding="0" cellspacing="0" dir="ltr" style="border: 0; width: 100%;">
											<tbody><tr>
												<td class="" style="padding: 20px 0; text-align: center; ;">
													<a href="#" style="text-decoration: none; font-size:40px;;" target="_blank">
														Aileensoul

													</a>
												</td>
											</tr>
										</tbody>
									</table>
									<table cellpadding="0" cellspacing="0" style="background: #ffffff; border: 0; border-radius: 4px; width: 100%;">
										<tbody>
											<tr>
												<td align="center" class="tw-card" style="padding: 20px 50px;">
													<table cellpadding="0" cellspacing="0" dir="ltr" style="border: 0; width: 100%;">
														<tbody>
														<tr>
															<td class="" style="padding: 20px 0; text-align: center; ;">
															<img alt="" class=" " src="https://static.twistapp.com/eee278cf8d8222ad8c36e3fdfeeafbf5.png" style="border: 0; height: auto; max-width: 100%; vertical-align: middle; ;" width="337">
															</td>
														</tr>
														</tbody>
													</table>
													<table cellpadding="0" cellspacing="0" dir="ltr" style="border: 0; width: 100%;">
														<tbody>
														<tr>
															<td class="" style="padding: 20px 0; text-align: left; color: #474747; font-family: sans-serif;;">
															<p style="margin: 20px 0;; font-size: 14px; mso-line-height-rule: exactly; line-height: 24px; margin: 30px 0;; ;">
															<span style="font-weight: bold;;">Thank you for joining the Aileensoul</span>
															</p>
															<p style="margin: 20px 0;; font-size: 14px; mso-line-height-rule: exactly; line-height: 24px; margin: 30px 0;; ;">
															Aileensoul is the communication app for teams who want to create a calmer, more organized, more productive workplace.
															</p>
															<p style="margin: 20px 0;; font-size: 14px; mso-line-height-rule: exactly; line-height: 24px; margin: 30px 0;; ;">
															We’ll send you an invite to get started soon!
															</p>
															<p style="margin: 20px 0;; font-size: 14px; mso-line-height-rule: exactly; line-height: 24px; margin: 30px 0;; ;">
															Have questions about the Beta? We’d love to help! Just hit reply :)
															</p>
															<p style="margin: 20px 0;; font-size: 14px; mso-line-height-rule: exactly; line-height: 24px; margin: 30px 0;; margin: 45px 0 0; ;">
																Our Best, <br> 
																<span style="font-weight: bold;;">Aileensoul team</span>
															</p>
														</td>
													</tr>
												</tbody>
												</table>
											</td>
										</tr>
										</tbody>
									</table>
									<table cellpadding="0" cellspacing="0" dir="ltr" style="border: 0; width: 100%;">
										<tbody>
										<tr>
											<td class="" style="padding: 20px 0; text-align: center; color: #8f8f8f; font-family: sans-serif; font-size: 12px; mso-line-height-rule: exactly; line-height: 20px;;">
												<p style="margin: 20px 0;; margin: 0;;">
													Made by the team across ten time zones at <a href="#" style="color: #316fea; text-decoration: none;" target="_blank">Aileensoul</a> ♡ We’re hiring!
												</p>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							</tr>
						</tbody>
						</table>

					</td>
				</tr>
			</tbody>
		</table>
    
</body>';

      //   echo $mail_html; 
         //Loading E-mail Class
//         $config['protocol'] = "smtp";
//         $config['smtp_host'] = $emailsetting[0]['host_name'];
//         $config['smtp_port'] = $emailsetting[0]['out_going_port'];
//         $config['smtp_user'] = $emailsetting[0]['user_name'];
//         $config['smtp_pass'] = $emailsetting[0]['password'];
//         $config['smtp_rec_email'] = $emailsetting[0]['receiver_email'];
//         $config['charset'] = "utf-8";
//         $config['mailtype'] = "html";
//         $config['newline'] = "\r\n";
         
        $config['protocol'] = "SMTP";
        $config['smtp_host'] = "SMTP.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "aileensoftsolution@gmail.com";
        $config['smtp_pass'] = "xyz123456";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

//         $this->email->initialize($config);
//         $this->email->from($config['smtp_user'], $app_name);
//          $this->email->cc($cc);
//         $this->email->bcc($bcc);
        //    $this->email->cc($cc);

//         $this->email->subject($subject);
//         $this->email->message(html_entity_decode($mail_body));
        $to = "khyati.aileensoul@gmail.com";
        $sub = "khytiii";

        $this->email->from('aileensoul@gmail.com', 'Aileensoul');
        $this->email->to($to);
        $this->email->reply_to('no-replay@aileensoul.com', 'Explendid Videos');
        $this->email->subject($sub);
        $this->email->message($mail_html);
        $this->email->set_mailtype("html");
        $this->email->send();
   
//echo '<pre>'; print_r($this->email->print_debugger()); die();
         if ($this->email->send()) {
            echo "111"; die();
             return true;
         } else {  echo "222"; die();
             return FALSE;
        }
    }


    function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL, $attachment_url=NULL)
    { 
         //echo $msg; echo "<br/>";
               //   echo $sub;  echo "<br/>";
               //   echo $to; echo "<br/>";
               //   echo $from; die();
       $this->load->library('email');
        $config['protocol'] = "SMTP";
        $config['smtp_host'] = "SMTP.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "aileensoftsolution@gmail.com";
        $config['smtp_pass'] = "xyz123456";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->email->initialize($config);

        // $system_name    =   $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
        // if ($from == NULL)
        //     $from       =   $this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
        $system_name ="aileensoul";
        // attachment
        //if ($attachment_url != NULL)
        //  $this->email->attach( $attachment_url );
            
         $this->email->from('aileensoul@gmail.com', 'Aileensoul');
        $this->email->to($to);
        $this->email->reply_to('no-replay@aileensoul.com', 'Explendid Videos');
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
   
        //echo $this->email->print_debugger(); die();
    }
    

}

