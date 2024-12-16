
<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
   <head>
      <title></title>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <!--[if mso]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            <o:AllowPNG/>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]--><!--[if !mso]><!-->
      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
      <!--<![endif]-->
      <style>
         * {
         box-sizing: border-box;
         }
         body {
         margin: 0;
         padding: 0;
         }
         a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: inherit !important;
         }
         #MessageViewBody a {
         color: inherit;
         text-decoration: none;
         }
         .button {
            background-color: #04AA6D; /* Green */
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
         }
         .button5 {
            background-color: white;
            color: black;
            border: 2px solid #555555;
         }

         .button5:hover {
         background-color: #555555;
         color: white;
         }
         p {
         line-height: inherit
         }
         .desktop_hide,
         .desktop_hide table {
         mso-hide: all;
         display: none;
         max-height: 0px;
         overflow: hidden;
         }
         .image_block img+div {
         display: none;
         }
         sup,
         sub {
         line-height: 0;
         font-size: 75%;
         }
         .menu_block.desktop_hide .menu-links span {
         mso-hide: all;
         }
         @media (max-width:700px) {
         .desktop_hide table.icons-inner,
         .social_block.desktop_hide .social-table {
         display: inline-block !important;
         }
         .icons-inner {
         text-align: center;
         }
         .icons-inner td {
         margin: 0 auto;
         }
         .mobile_hide {
         display: none;
         }
         .row-content {
         width: 100% !important;
         }
         .stack .column {
         width: 100%;
         display: block;
         }
         .mobile_hide {
         min-height: 0;
         max-height: 0;
         max-width: 0;
         overflow: hidden;
         font-size: 0px;
         }
         .desktop_hide,
         .desktop_hide table {
         display: table !important;
         max-height: none !important;
         }
         .reverse {
         display: table;
         width: 100%;
         }
         .reverse .column.first {
         display: table-footer-group !important;
         }
         .reverse .column.last {
         display: table-header-group !important;
         }
         .row-3 td.column.first .border,
         .row-3 td.column.last .border {
         padding: 0;
         border-top: 0;
         border-right: 0px;
         border-bottom: 0;
         border-left: 0;
         }
         }

         .img-style{
            width: 100%;
            height: auto;

         }
         .title-observaciones{
            font-size: 20px;
            font-weight: 700;
            text-align: left !important;
         }
         .text-observaciones{
            text-align: left !important;
         }
      </style>
      <!--[if mso ]>
      <style>sup, sub { font-size: 100% !important; } sup { mso-text-raise:10% } sub { mso-text-raise:-10% }</style>
      <![endif]-->
   </head>

   {{-- {!!$course->observation()->get()->last()->content!!} --}}
   {{-- {{$course->title}} --}}

   <body class="body" style="background-color: #efefef; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
      <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #efefef;" width="100%">
        <tbody>
            <tr>
                <td>

                    <!--bloque de logo-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin-bottom: 10px;" width="100%">
                    <tbody>
                        <tr>
                            <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px; margin: 0 auto;" width="680">
                                <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                        <table border="0" cellpadding="20" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            <tr>
                                                <td class="pad">
                                                    <div align="center" class="alignment" style="line-height:10px">
                                                    <div style="max-width: 134.667px;"><img alt="Logo" height="auto" src="{{asset('img/mails/reject-course/Beefree-logo.png')}}" style="display: block; height: auto; border: 0; width: 100%;" title="Your Logo" width="134.667"/></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!--Bloque del boton para ver los detalles de las observaciones y una imagen-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>

                <!--content-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px; margin: 0 auto;" width="600">
                  <tbody>
                     <tr>
                        <td>
                           <div style="background-color: #ffffff; padding:20px">
                                {{$slot}}
                           </div>
                        </td>
                     </tr>
                  </tbody>
                </table>
   

                <!--bloque redes sociales-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                    <tbody>
                       <tr>
                          <td>
                             <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px; margin: 0 auto;" width="680">
                                <tbody>
                                   <tr>
                                      <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                         
                                          <!--Enlaces de paginas-->
                                          <table border="0" cellpadding="0" cellspacing="0" class="menu_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            <tr>
                                               <td class="pad" style="color:#adadad;font-family:inherit;font-size:14px;padding-bottom:15px;padding-left:25px;padding-right:25px;padding-top:15px;text-align:center;">
                                                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                     <tr>
                                                        <td class="alignment" style="text-align:center;font-size:0px;">
                                                           <div class="menu-links">
                                                              <!--[if mso]>
                                                              <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" style="">
                                                                 <tr style="text-align:center;">
                                                                    <![endif]--><!--[if mso]>
                                                                    <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                       <![endif]--><a href="{{route('welcome')}}" style="mso-hide:false;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;display:inline-block;color:#adadad;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;text-decoration:none;letter-spacing:normal;" target="_self">Home</a><!--[if mso]>
                                                                    </td>
                                                                    <td>
                                                                       <![endif]--><span class="sep" style="word-break: break-word; font-size: 14px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #adadad;">|</span><!--[if mso]>
                                                                    </td>
                                                                    <![endif]--><!--[if mso]>
                                                                    <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                       <![endif]--><a href="{{route('courses.index')}}" style="mso-hide:false;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;display:inline-block;color:#adadad;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;text-decoration:none;letter-spacing:normal;" target="_self">Cursos</a><!--[if mso]>
                                                                    </td>
                                                                    <td>
                                                                       <![endif]--><span class="sep" style="word-break: break-word; font-size: 14px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #adadad;">|</span><!--[if mso]>
                                                                    </td>
                                                                    <![endif]--><!--[if mso]>
                                                                    <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                                                                       <![endif]--><a href="{{route('posts.index')}}" style="mso-hide:false;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;display:inline-block;color:#adadad;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;text-decoration:none;letter-spacing:normal;" target="_self">Blog</a><!--[if mso]>
                                                                    </td>
                                                                    <![endif]--><!--[if mso]>
                                                                 </tr>
                                                              </table>
                                                              <![endif]-->
                                                           </div>
                                                        </td>
                                                     </tr>
                                                  </table>
                                               </td>
                                            </tr>
                                         </table>
  
                                         <!--logos redes sociales-->
                                         <table border="0" cellpadding="10" cellspacing="0" class="social_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                            <tr>
                                               <td class="pad">
                                                  <div align="center" class="alignment">
                                                     <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="156px">
                                                        <tr>
                                                           <td style="padding:0 10px 0 10px;"><a href="https://www.facebook.com" target="_blank"><img alt="Facebook" height="auto" src="{{asset('img/mails/reject-course/facebook2x.png')}}" style="display: block; height: auto; border: 0;" title="Facebook" width="32"/></a></td>
                                                           <td style="padding:0 10px 0 10px;"><a href="https://www.twitter.com" target="_blank"><img alt="Twitter" height="auto" src="{{asset('img/mails/reject-course/instagram2x.png')}}" style="display: block; height: auto; border: 0;" title="Twitter" width="32"/></a></td>
                                                           <td style="padding:0 10px 0 10px;"><a href="https://www.instagram.com" target="_blank"><img alt="Instagram" height="auto" src="{{asset('img/mails/reject-course/twitter2x.png')}}" style="display: block; height: auto; border: 0;" title="Instagram" width="32"/></a></td>
                                                        </tr>
                                                     </table>
                                                  </div>
                                               </td>
                                            </tr>
                                         </table>
  
                                      </td>
                                   </tr>
                                </tbody>
                             </table>
                          </td>
                       </tr>
                    </tbody>
                </table>


                <!--mensaje politica de privacidad-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                    <tbody>
                        <tr>
                            <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px; margin: 0 auto;" width="680">
                                <tbody>
                                    <tr>
                                        <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                        <div class="spacer_block block-1" style="height:20px;line-height:20px;font-size:1px;"> </div>
                                        <table border="0" cellpadding="0" cellspacing="0" class="paragraph_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                            <tr>
                                                <td class="pad" style="padding-bottom:30px;padding-left:30px;padding-right:30px;padding-top:5px;">
                                                    <div style="color:#c0c0c0;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:12px;line-height:150%;text-align:center;mso-line-height-alt:18px;">
                                                    <p style="margin: 0; word-break: break-word;"><span style="word-break: break-word;">If you have questions regarding your data, please visit our <a href="{{route('pages.privacidad')}}" rel="noopener" style="text-decoration: underline; color: #c2c2c2;" target="_blank">Privacy Policy</a> </span></p>
                                                    <p style="margin: 0; word-break: break-word;"><span style="word-break: break-word;"><span style="word-break: break-word;">You can <a href="#" rel="noopener" style="text-decoration: underline; color: #c2c2c2;" target="_blank">update your preferences</a> or <a href="#" rel="noopener" style="text-decoration: underline; color: #c2c2c2;" target="_blank">unsubscribe</a> from this list.</span></span></p>
                                                    <p style="margin: 0; word-break: break-word;"><span style="word-break: break-word;">© {{date('Y')}} Company. All Rights Reserved.</span></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
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
   </body>
</html>