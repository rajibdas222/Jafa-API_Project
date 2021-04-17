<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# includes the autoloader for libraries installed with composer
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\Configuration;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetBrowseNodesRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetBrowseNodesResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\PartnerType;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\ProductAdvertisingAPIClientException;

require_once('vendor/autoload.php'); // change path as needed

class Main_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url', 'photo'));
        $this->load->library(array('account/authentication', 'account/authorization', 'form_validation', 'gravatar'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'points_model', 'giftcode_model'));
        $this->load->language(array('general', 'account/sign_in'));
    }

    public function index()
    {
        $data = array();
        $data['referal'] = $this->input->get('refaral');
        $data['parent_id'] = 32;
        $data['tracking_id'] = "nonmenber";
        // $data['charin_parcentage'] = array();
        $default_parcentage = $this->db->where('user_id', 32)->get('company_margin_distribution')->row();
        $data['charin_pint'] = $default_parcentage->member_mar;
        if (!empty($data['referal'])) {
            $data['referal_info'] = $this->account_model->get_by_username_email($data['referal']);
            $data['parent_id'] = $data['referal_info']->id;
            $default_parcentage = $this->db->where('user_id', $data['referal_info']->id)->get('company_margin_distribution')->row();
            if (!empty($default_parcentage)) {
                $data['charin_pint'] = $default_parcentage->member_mar;
            }
        }
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $data['account_role'] = $this->account_model->get_by_username_email($data['account']->username);

            if (empty($data['account']->parent_id)) {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->id)->get('company_margin_distribution')->row();
                if (!empty($data['charin_parcentage'])) {
                    // $data['charin_pint'] = $data['charin_parcentage']->com_mar;
                    $data['charin_pint'] = $data['charin_parcentage']->member_mar;
                }
            } else {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->parent_id)->get('company_margin_distribution')->row();
                if (!empty($data['charin_parcentage'])) {
                    $data['charin_pint'] = $data['charin_parcentage']->member_mar;
                }
            }


            $parent_trking = '';
            if ($data['account']->parent_id) {
                $data['parent_info'] = $this->account_model->get_by_id($data['account']->parent_id);
                $parent_trking = $data['parent_info']->tracking_id;
            }

            if ($data['account']->role_id == 1) {
                $data['tracking_id'] = "nonmenber";
            } elseif ($data['account']->role_id == 2) {
                $first_member_of_company = $this->db->where('parent_id', $data['account']->id)->order_by('tracking_id', 'ASC')->get('a3m_account')->row();
                if (!empty($first_member_of_company)) {
                    $data['tracking_id'] = $data['account']->tracking_id . $first_member_of_company->tracking_id;
                } else {
                    $data['tracking_id'] = $data['account']->tracking_id;
                }

            } else {
                $data['tracking_id'] = $parent_trking . $data['account']->tracking_id;
            }
        }
        $this->load->view('compare', $data);
    }

    public function amazon_new_api()
    {
        $data = array();
        $data['referal'] = $this->input->get('refaral');

        $referal = $this->input->get('refaral');
        $data['parent_id'] = 32;
        $data['tracking_id'] = "nonmenber";
        // $data['charin_parcentage'] = array();
        $default_parcentage = $this->db->where('user_id', 32)->get('company_margin_distribution')->row();
        $data['charin_pint'] = $default_parcentage->member_mar;
        if (!empty($data['referal'])) {
            $data['referal_info'] = $this->account_model->get_by_username_email($referal);
            $default_parcentage = $this->db->where('user_id', $data['referal_info']->id)->get('company_margin_distribution')->row();
            if (!empty($default_parcentage)) {
                $data['charin_pint'] = $default_parcentage->member_mar;
            }
        }
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $data['account_role'] = $this->account_model->get_by_username_email($data['account']->username);

            if (empty($data['account']->parent_id)) {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->id)->get('company_margin_distribution')->row();
                if (!empty($data['charin_parcentage'])) {
                    // $data['charin_pint'] = $data['charin_parcentage']->com_mar;
                    $data['charin_pint'] = $data['charin_parcentage']->member_mar;
                }
            } else {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->parent_id)->get('company_margin_distribution')->row();
                if (!empty($data['charin_parcentage'])) {
                    $data['charin_pint'] = $data['charin_parcentage']->member_mar;
                }
            }

            $parent_trking = '';
            // if (strlen($data['account']->tracking_id)>5) {
            // 	$parent_trking = 'jacos';
            // }

            if ($data['account']->parent_id) {
                $data['parent_info'] = $this->account_model->get_by_id($data['account']->parent_id);
                $parent_trking = $data['parent_info']->tracking_id;
            }

            if ($data['account']->role_id == 1) {
                $data['tracking_id'] = "nonmenber";
            } elseif ($data['account']->role_id == 2) {
                $first_member_of_company = $this->db->where('parent_id', $data['account']->id)->order_by('tracking_id', 'ASC')->get('a3m_account')->row();
                $data['tracking_id'] = $data['account']->tracking_id . $first_member_of_company->tracking_id;
            } else {
                $data['tracking_id'] = $parent_trking . $data['account']->tracking_id;
            }
        }
        $this->load->view('compare4', $data);
    }

    public function compare()
    {
        redirect(base_url());
        // Enable SSL?
        $data = array();
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        }

        $this->load->view('compare2', $data);
    }

    public function test_email()
    {
        $this->load->language(array('account/forgot_password'));
        // $data['activation_url'] = anchor("https://jafa.dev.jacos.jp", "登録確認", 'title="登録確認", class="btn btn-primary btn-lg"');
        $data['password_reset_url'] = anchor("https://jafa.dev.jacos.jp", "パスワード再設定", 'title="パスワード再設定", class="" style="padding: 10px;font-size: 22px;background-color: #007bff;border-color: #007bff;text-decoration: none; color: white; text-align: center; vertical-align: middle; cursor: pointer;border-radius: 5px; display: inline-block; font-weight: 400;" target="_blank"');
        $data['fullname'] = "Jacos Jasim Islam";
        $this->load->view('account/reset_password_email', $data);
    }

    public function member_margine()
    {
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'member_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('member_margin')) {
            redirect(base_url());
        }

        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        $this->load->view('member_margine', $data);
    }

    public function company_margine()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }

        $this->load->view('company/company_margine', $data);
    }

    public function company_point()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }

        $this->load->view('company_point', $data);
    }

    public function member_point()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }


        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        $data['member_purchase'] = $this->points_model->get_customer_purchase_list($data['account']->id);
        // echo "<pre>"; print_r($data['member_purchase']);
        // exit();
        $this->load->view('member_point', $data);
    }

    public function admin_company_point()
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'admin_company_point'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        //$data['member_points'] = $this->points_model->get_member_point();
//		 echo "<pre>"; print_r($data['member_points']);
//		 exit();
        $this->load->view('admin/admin_company_point', $data);
    }

    public function shop_margine()
    {
        // Enable SSL?
        $data = array();
        maintain_ssl($this->config->item("ssl_enabled"));
        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        $this->load->view('shop_margine', $data);
    }

    public function points()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'points'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('retrieve_roles')) {
            redirect('account/account_profile');
        }


        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        $data['member_companies'] = $this->points_model->get_company();

        $this->load->view('points', $data);
    }

    public function get_janmaster()
    {
        $jan_code = $this->input->post('jan_code');
        if ($jan_code != "") {
            $jan_product = $this->get_jan_product_from_api($jan_code);
            if (!empty($jan_product)) {
                echo json_encode($jan_product);
            } else {
                echo "invalid";
            }
        }
    }


    public function get_jan_product_from_api($jan_code = NULL)
    {
        // $jan_codess = "4902110374803";
        $jan_codess = $this->input->post('jan_code');
        $this->db->where('pro_jan_code', $jan_code);
        $query = $this->db->get('est_product_table');
        return $query->row();
        $ch = curl_init();
        $fields = array('jan' => $jan_code);
        $postvars = '';
        foreach ($fields as $key => $value) {
            $postvars .= $key . "=" . $value . "&";
        }

        $url = "http://10.128.9.21/janmaster/select_jan.php";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public function yahoo_api($jan_code = NULL)
    {
        if (empty($jan_code)) {
            $jan_code = $this->input->post('barcode');
        }

        $tracking_id = "sei010000000009";
        $parent_trking = 'jacos';
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            if ($data['account']->parent_id != "") {
                $parent_info = $this->account_model->get_by_id($data['account']->parent_id);
                $parent_trking = $parent_info->tracking_id;
            }

            $tracking_id = $parent_trking . $data['account']->tracking_id;
        }

        $sort = "+price";

        // Yahoo API version V1 has stoped
        // $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=".$jan_code."&hits=50&offset=0&price_from=2&sort=%2Bprice&condition=new&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D";

        // Yahoo API Version V3 has developed 07 July 2020
        $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=" . urlencode($jan_code) . "&price_from=2&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D&condition=new&start=1&results=1&sort=" . urlencode($sort);


        // create curl resource
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        // echo "<pre>"; print_r(json_decode($resp));
        // exit();
        echo $resp;
    }

    public function get_rakuten_product_api($jan_code)
    {
        $url = "https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?applicationId=1020698445083246210&sort=%2BitemPrice&affiliateId=13cd26fa.6f864c06.13cd26fb.0eadff3c&keyword=$jan_code";
        // echo $url;
        // exit();
        // create curl resource
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        // print_r($resp);
        echo json_encode($resp);
    }

    public function get_amazon_by_api($jan_code = NULL)
    {
        if (empty($jan_code)) {
            $jan_code = $this->input->post('barcode');
        }

        $tracking_id = "nonmenber-22";
        // $parent_trking = 'jacos';
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            if ($data['account']->parent_id != "" || $data['account']->role_id == 2) {
                if ($data['account']->role_id == 2) {
                    $first_member_of_company = $this->db->where('parent_id', $data['account']->id)->order_by('tracking_id', 'ASC')->get('a3m_account')->row();
                    $tracking_id = $data['account']->tracking_id . $first_member_of_company->tracking_id . "-22";
                } else {
                    $parent_info = $this->account_model->get_by_id($data['account']->parent_id);
                    $parent_trking = $parent_info->tracking_id;
                    $tracking_id = $parent_trking . $data['account']->tracking_id . "-22";
                }
            }

        }

        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";

        // Your Secret Key corresponding to the above ID, as taken from the Your Account page
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";

        // The region you are interested in
        $endpoint = "webservices.amazon.co.jp";

        $uri = "/onca/xml";

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAIG3EPZUI7TX5RTRA",
            "AssociateTag" => $tracking_id,
            "SearchIndex" => "All",
            "ResponseGroup" => "Images,ItemAttributes,Offers,Reviews,EditorialReview, BrowseNodes, OfferFull, ItemInfo.ExternalIds",
            "Keywords" => "$jan_code"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n" . $endpoint . "\n" . $uri . "\n" . $canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));

        // Generate the signed URL
        $request_url = 'https://' . $endpoint . $uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request_url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        echo $resp;
    }


    public function get_amazon_api_url($jan_code)
    {
        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";

        // Your Secret Key corresponding to the above ID, as taken from the Your Account page
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";

        // The region you are interested in
        $endpoint = "webservices.amazon.co.jp";

        $uri = "/onca/xml";

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAIG3EPZUI7TX5RTRA",
            "AssociateTag" => "jouene0f-22",
            "SearchIndex" => "All",
            "ResponseGroup" => "Images,ItemAttributes,Offers,Reviews,EditorialReview, BrowseNodes, OfferFull, ItemInfo.ExternalIds",
            "Keywords" => "$jan_code"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n" . $endpoint . "\n" . $uri . "\n" . $canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));

        // Generate the signed URL
        $request_url = 'https://' . $endpoint . $uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);

        echo "Signed URL: \"" . $request_url . "\"";

    }

    public function get_affiliate_products($barcode)
    {
        $amazon_data = $this->get_amazon_by_api($barcode);
        $amazon_data2 = $this->xml_to_array($amazon_data);
        // print_r($amazon_data);
        // exit();
        $yahoo_data = $this->yahoo_api($barcode);
    }

    function xml_to_array($xml_data)
    {
        // read the XML database of aminoacids
        // $data = implode("", file($filename));
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $xml_data, $values, $tags);
        xml_parser_free($parser);

        $arrayData = array();
        // loop through the structures
        foreach ($tags as $key => $val) {
            if ($key == "ItemSearchResponse") {
                $molranges = $val;
                // each contiguous pair of array entries are the
                // lower and upper range for each molecule definition
                for ($i = 0; $i < count($molranges); $i += 2) {
                    $offset = $molranges[$i] + 1;
                    $len = $molranges[$i + 1] - $offset;
                    $arrayData[] = parseMol(array_slice($values, $offset, $len));
                }
            } else {
                continue;
            }
        }
        return $arrayData;
    }

    function parseMol($mvalues)
    {
        for ($i = 0; $i < count($mvalues); $i++) {
            $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
        }
        return new AminoAcid($mol);
    }

    public function get_browse_node_commission($node_info = NULL)
    {
        // $node_info = $this->input->post("node_info");
        // echo $node_info;
        // exit();
        if (!empty($node_info)) {
            $this->db->where('browse_node_id', $node_info);
            $query = $this->db->get('amazon_commission_rate');
            $result = $query->row();
            echo json_encode($result);
        } else {
            echo "error";
        }
    }

    public function get_browse_node_commission2()
    {
        $node_info = $this->input->post("node_ids");

        $node_array = json_decode($node_info);
        // if (is_array($node_array)) {
        // 	echo "Not array";
        // }else{
        // 	print_r($node_array);
        // }
        // print_r($node_array);
        // exit();
        if (is_array($node_array) && count($node_array) > 0) {
            $i = 1;
            foreach ($node_array as $key => $node) {
                $this->db->where('browse_node_id', $node->BrowseNodeId);
                $query = $this->db->get('amazon_commission_rate');
                $result = $query->row();
                $response_result = array();
                if (!empty($result)) {
                    $response_result = $result;
                    echo json_encode($response_result);
                    exit();
                }
                if ($i == count($node_array)) {
                    $response_result = $result;
                    echo json_encode($response_result);
                    exit();
                }
                $i++;
            }
        } else {
            $this->db->where('browse_node_id', $node_array->BrowseNodeId);
            $query = $this->db->get('amazon_commission_rate');
            $result = $query->row();
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode($result);
            }
        }

    }

    public function get_browse_node_commission3()
    {
        $node_info = $this->input->post("node_ids");

        $node_array = json_decode($node_info);
        if (!empty($node_array)) {
            $this->db->where('browse_node_id', $node_array->Id);
            $query = $this->db->get('amazon_commission_rate');
            $result = $query->row();
            if (!empty($result)) {
                echo json_encode($result);
            } elseif (!empty($node_array->Ancestor)) {
                $this->db->where('browse_node_id', $node_array->Ancestor->Id);
                $query = $this->db->get('amazon_commission_rate');
                $result = $query->row();
                if (!empty($result)) {
                    echo json_encode($result);
                } elseif (!empty($node_array->Ancestor->Ancestor)) {
                    $this->db->where('browse_node_id', $node_array->Ancestor->Ancestor->Id);
                    $query = $this->db->get('amazon_commission_rate');
                    $result = $query->row();
                    if (!empty($result)) {
                        echo json_encode($result);
                    } elseif (!empty($node_array->Ancestor->Ancestor->Ancestor)) {
                        $this->db->where('browse_node_id', $node_array->Ancestor->Ancestor->Ancestor->Id);
                        $query = $this->db->get('amazon_commission_rate');
                        $result = $query->row();
                        echo json_encode($result);
                    }
                }
            }
        } else {
            $this->db->where('browse_node_id', $node_array->Id);
            $query = $this->db->get('amazon_commission_rate');
            $result = $query->row();
            if (!empty($result)) {
                // echo "Ahsan Ullah3";
                // print_r($result);
                echo json_encode($result);
                exit();
            } else {
                // echo "Ahsan Ullah4";
                // print_r($result);
                echo json_encode($result);
            }
        }

    }

    public function get_browse_node_commission4()
    {
        $node_info = $this->input->post("node_ids");
        $node_array = json_decode($node_info);
        // foreach ($node_array as $key => $node) {
        $this->db->where_in('browse_node_id', $node_array);
        $query = $this->db->get('amazon_commission_rate');
        $result = $query->row();
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(array());
        }

        // exit();
        // }
        // print_r($node_array);
        // exit();
        // if (!empty($node_array)) {
        // 	$this->db->where('browse_node_id', $node_array->Id);
        // 	$query = $this->db->get('amazon_commission_rate');
        // 	$result = $query->row();
        // 	if (!empty($result)) {
        // 		echo json_encode($result);
        // 	}elseif (!empty($node_array->Ancestor)) {
        // 		$this->db->where('browse_node_id', $node_array->Ancestor->Id);
        // 		$query = $this->db->get('amazon_commission_rate');
        // 		$result = $query->row();
        // 		if (!empty($result)) {
        // 			echo json_encode($result);
        // 		}elseif (!empty($node_array->Ancestor->Ancestor)) {
        // 			$this->db->where('browse_node_id', $node_array->Ancestor->Ancestor->Id);
        // 			$query = $this->db->get('amazon_commission_rate');
        // 			$result = $query->row();
        // 			if (!empty($result)) {
        // 				echo json_encode($result);
        // 			}elseif (!empty($node_array->Ancestor->Ancestor->Ancestor)) {
        // 				$this->db->where('browse_node_id', $node_array->Ancestor->Ancestor->Ancestor->Id);
        // 				$query = $this->db->get('amazon_commission_rate');
        // 				$result = $query->row();
        // 				echo json_encode($result);
        // 			}
        // 		}
        // 	}
        // }else{
        // 	$this->db->where('browse_node_id', $node_array->Id);
        // 	$query = $this->db->get('amazon_commission_rate');
        // 	$result = $query->row();
        // 	if (!empty($result)) {
        // 		echo json_encode($result);
        // 		exit();
        // 	}else{
        // 		echo json_encode($result);
        // 	}
        // }

    }

    public function save_points()
    {
        $member_com_id = $this->input->post('member_com_id');
        $member_name = $this->input->post('member_name');
        $item_sales_amount = $this->input->post('item_sales_amount');
        $chalin_two = $this->input->post('chalin_two');
        if (!empty($member_com_id)) {
            $member_data = array(
                'item_sales_amount' => $item_sales_amount,
                'chalin_two' => $chalin_two
            );
        } else {
            $member_data = array(
                'member_name' => $member_name,
                'item_sales_amount' => $item_sales_amount,
                'chalin_two' => $chalin_two
            );
        }

        // print_r($member_data);
        // exit();
        $this->points_model->_table_name = 'member_company';
        $this->points_model->_primary_key = 'member_com_id';

        if ($member_com_id) {
            $this->points_model->save($member_data, $member_com_id);
        } else {
            $member_com_id = $this->points_model->save($member_data);
        }
    }

    public function save_percentage()
    {
        // $com_mar = $this->input->post('com_mar');
        // $member_mar = $this->input->post('member_mar');
        // $field_name = $this->input->post('field_name');
        $company_id = $this->input->post('company_id');
        // $percentage = $this->input->post('percentage');
        $com_mar_percentage = $this->input->post('com_mar_percentage');
        $member_mar_percentage = $this->input->post('member_mar_percentage');
        $update_array = array();
        // if (!empty($member_com_id)) {

        // Update
        $exit = $this->db->where('user_id', $company_id)->get('company_margin_distribution')->row();
        if ($exit) {
            $member_data = array("com_mar" => $com_mar_percentage, 'member_mar' => $member_mar_percentage);
            $this->db->where('user_id', $company_id);
            $this->db->update('company_margin_distribution', $member_data);
        } // Insert
        else {
            $member_data = array("com_mar" => $com_mar_percentage, 'member_mar' => $member_mar_percentage, 'user_id' => $company_id);
            $this->db->insert('company_margin_distribution', $member_data);
        }
        echo $this->db->last_query();
    }

    public function get_member_company()
    {
        $member_companies = $this->points_model->get_member_company();
        echo json_encode($member_companies);
    }

    //Get company details
    public function get_company()
    {
        $member_companies = $this->points_model->get_company();

//        echo "<pre>";
//        print_r($member_companies);
//        exit();
        echo json_encode($member_companies);
    }

    public function get_company_summary()
    {
        $company_list = $this->points_model->company_list();
        // print_r($company_list);
        // exit();
        $company_summary = array();
        foreach ($company_list as $key => $company) {
            $company_total = $this->points_model->get_summary_by_com_id($company->user_id);

            $item_sales_amount = $company_total->item_sales_amount;
            $chalin_two = $company_total->chalin_two;
            if ($item_sales_amount == NULL) {
                $item_sales_amount = 0;
            }
            if ($chalin_two == NULL) {
                $chalin_two = 0;
            }
            // echo $chalin_two;
            // exit();
            $sum_data['item_sales_amount'] = $item_sales_amount;
            $sum_data['chalin_two'] = $chalin_two;
            $sum_data['user_id'] = $company->user_id;
            $sum_data['company_name'] = $company->company_name;
            $sum_data['com_mar'] = $company->com_mar == NULL ? 0 : $company->com_mar;
            $sum_data['member_mar'] = $company->member_mar == NULL ? 0 : $company->member_mar;
            $sum_data['service_charge'] = $company->service_charge == NULL ? 0 : $company->service_charge;
            $sum_data['major_company'] = $company->major_company_jacos;
            $sum_data['role_name'] = $company->role_name;

            $company_summary['all_company'][] = $sum_data;
        }

        // echo "<pre>"; print_r($company_summary['all_company']);
        // exit();
        $company_summary['jacos'] = $this->points_model->jacos_summary();

        // echo $this->db->last_query();
        echo json_encode($company_summary);
    }

    public function new_get_company_summary($period = NULL, $end_date = NULL)
    {
        $company_list = $this->points_model->company_list();
        $data = array();
        $company_summary = array();
        // $data['unknown_per'] = $this->points_model->get_summary_by_unknown('perm', $period, $end_date);
        // $data['unknown_temp'] = $this->points_model->get_summary_by_unknown('temp', $period, $end_date);
        foreach ($company_list as $key => $company) {
            $company_temp_total = $this->points_model->get_temp_summary_by_com_id($company->user_id, $period, $end_date);

            $company_per_total = $this->points_model->get_per_summary_by_com_id($company->user_id, $period, $end_date);

            $company_exchange_total = $this->points_model->get_total_excange_by_com_id($company->user_id, $period, $end_date);

            $temp_order_amount = $company_temp_total->order_amount == NULL ? 0 : $company_temp_total->order_amount;
            $temp_point_amount = $company_temp_total->point_amount == NULL ? 0 : $company_temp_total->point_amount;

            $per_order_amount = $company_per_total->order_amount == NULL ? 0 : $company_per_total->order_amount;
            $per_point_amount = $company_per_total->point_amount == NULL ? 0 : $company_per_total->point_amount;
            $sum_data['user_id'] = $company->user_id;
            $sum_data['major_company'] = $company->major_company_jacos;
            $sum_data['role_name'] = $company->role_name;
            $sum_data['company_name'] = $company->company_name;
            $sum_data['member_mar'] = $company->member_mar;
            $sum_data['com_mar'] = $company->com_mar;
            // Temporary Points
            $sum_data['temp_order_amount'] = $temp_order_amount;
            $sum_data['temp_point_amount'] = $temp_point_amount;
            $sum_data['temp_company_point'] = $company_temp_total->company_point == NULL ? 0 : $company_temp_total->company_point;
            $sum_data['temp_user_point'] = $company_temp_total->user_point == NULL ? 0 : $company_temp_total->user_point;
            $sum_data['temp_jafa_point'] = $company_temp_total->jafa_point == NULL ? 0 : $company_temp_total->jafa_point;
            // Permanent Point
            $sum_data['per_order_amount'] = $per_order_amount;
            $sum_data['per_point_amount'] = $per_point_amount;
            $sum_data['per_company_point'] = $company_per_total->company_point == NULL ? 0 : $company_per_total->company_point;
            $sum_data['per_user_point'] = $company_per_total->user_point == NULL ? 0 : $company_per_total->user_point;
            $sum_data['per_jafa_point'] = $company_per_total->jafa_point == NULL ? 0 : $company_per_total->jafa_point;

            // Excenge report
            $sum_data['user_point_exange'] = $company_exchange_total->amount == NULL ? 0 : $company_exchange_total->amount;

            $company_summary[] = $sum_data;
        }
        $data['company_summary'] = $company_summary;
        echo json_encode($data);
    }

    public function get_company_category($period = NULL, $end_date = NULL)
    {
        $company_list = $this->points_model->company_list();
        // print_r($company_list);
        // exit();
        $data = array();
        $company_summary = array();
        // $data['unknown_per'] = $this->points_model->get_summary_by_unknown('perm', $period, $end_date);
        // $data['unknown_temp'] = $this->points_model->get_summary_by_unknown('temp', $period, $end_date);
        foreach ($company_list as $key => $company) {
            $company_temp_total = $this->points_model->get_temp_summary_by_com_id($company->user_id, $period, $end_date);

            $company_per_total = $this->points_model->get_per_summary_by_com_id($company->user_id, $period, $end_date);

            $company_exchange_total = $this->points_model->get_total_excange_by_com_id($company->user_id, $period, $end_date);

            $temp_order_amount = $company_temp_total->order_amount == NULL ? 0 : $company_temp_total->order_amount;
            $temp_point_amount = $company_temp_total->point_amount == NULL ? 0 : $company_temp_total->point_amount;

            $per_order_amount = $company_per_total->order_amount == NULL ? 0 : $company_per_total->order_amount;
            $per_point_amount = $company_per_total->point_amount == NULL ? 0 : $company_per_total->point_amount;
            $sum_data['user_id'] = $company->user_id;
            $sum_data['major_company'] = $company->major_company_jacos;
            $sum_data['role_name'] = $company->role_name;
            $sum_data['company_name'] = $company->company_name;
            $sum_data['member_mar'] = $company->member_mar;
            $sum_data['com_mar'] = $company->com_mar;
            // Temporary Points
            $sum_data['temp_order_amount'] = $temp_order_amount;
            $sum_data['temp_point_amount'] = $temp_point_amount;
            $sum_data['temp_company_point'] = $company_temp_total->company_point == NULL ? 0 : $company_temp_total->company_point;
            $sum_data['temp_user_point'] = $company_temp_total->user_point == NULL ? 0 : $company_temp_total->user_point;
            $sum_data['temp_jafa_point'] = $company_temp_total->jafa_point == NULL ? 0 : $company_temp_total->jafa_point;
            // Permanent Point
            $sum_data['per_order_amount'] = $per_order_amount;
            $sum_data['per_point_amount'] = $per_point_amount;
            $sum_data['per_company_point'] = $company_per_total->company_point == NULL ? 0 : $company_per_total->company_point;
            $sum_data['per_user_point'] = $company_per_total->user_point == NULL ? 0 : $company_per_total->user_point;
            $sum_data['per_jafa_point'] = $company_per_total->jafa_point == NULL ? 0 : $company_per_total->jafa_point;

            // Excenge report
            $sum_data['user_point_exange'] = $company_exchange_total->amount == NULL ? 0 : $company_exchange_total->amount;

            $company_summary[] = $sum_data;
        }
        $data['company_summary'] = $company_summary;
        echo json_encode($data);
    }


    public function add_purchage()
    {
        $account_id = 0;
        $parent_id = 0;
        $tracking_no = NULL;
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $account_id = $this->session->userdata('account_id');
            $parent_id = $data['account']->parent_id;
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $data['parent_info'] = $this->account_model->get_by_id($data['account']->parent_id);
            $tracking_no = $data['parent_info']->tracking_id . $data['account']->tracking_id;
        }
        $price = $this->input->post('price');
        $shop_point = $this->input->post('shop_point');
        $point = $this->input->post('point');
        $barcode = $this->input->post('barcode');
        $product_name = $this->input->post('product_name');
        $affiliate_rate = $this->input->post('affiliate_rate');
        $price = (int)preg_replace('/\D/', '', $price);
        $shop_id = 0;
        $shop_name = $this->input->post('shop_name');
        if ($shop_name == 'アマゾン') {
            $shop_id = 1;
        } elseif ($shop_name == 'ヤフー') {
            $shop_id = 2;
        } elseif ($shop_name == '楽天') {
            $shop_id = 3;
        }


        // $com_name = "ジャコス";
        $month = date('Y-m');
        $date = date('Y-m-d H:i:s');

        $data = array(
            'user_id' => $account_id,
            'company_id' => $parent_id,
            'shop_id' => $shop_id,
            'barcode' => $barcode,
            'product_name' => $product_name,
            'item_sales_amount' => $price,
            'chalin_two' => $point,
            'asin_no' => $this->input->post('asin'),
            'tracking_no' => $tracking_no,
            'affiliate_rate' => $this->input->post('affiliate_rate'),
            'shop_point' => $shop_point,
            'entry_month' => $month,
            'entry_date' => $date
        );

        // print_r($data);
        // exit();
        $this->points_model->_table_name = 'customer_purchase';
        $this->points_model->_primary_key = 'purchase_id';
        $id = $this->points_model->save($data);
    }

    public function test_scanner()
    {
        $this->load->view('scanner');
    }

    public function login_search()
    {
        $user = $this->account_model->get_by_username_email($this->input->post('customer_username_email', TRUE));
        if ($user) {
            // Check password
            if ($this->authentication->check_password($user->password, $this->input->post('sign_in_password', TRUE))) {
                $user_info['basic_info'] = $user;
                $user_info['details_info'] = $this->account_details_model->get_by_account_id($user->id);
                // Run sign in routine
                $this->authentication->sign_in($user->id);
                echo json_encode($user_info);
            } else {
                // Password is Incorrect
                echo "error_password";
            }

        } else {
            echo "error";
        }
    }

    public function get_all_nodes()
    {
        $query = $this->db->get("amazon_commission_rate");
        echo json_encode($query->result());
    }

    public function get_company_member()
    {
        $user_id = $this->input->post('user_id');
        $month = $this->input->post('month');
        $month = $month == 'null' ? NULL : $month;
        $end_date = $this->input->post('end_date');
        $end_date = $end_date == 'null' ? NULL : $end_date;

        if ($this->authentication->is_signed_in()) {
            if ($user_id == "" || $user_id == 'null') {
                $user_id = $this->session->userdata('account_id');
            }

            if ($user_id == 'all') {
                $user_id = NULL;
            }

            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

            $data['company_details'] = $this->points_model->get_company_details($user_id);

            $company_members = $this->points_model->get_company_member($user_id);
            $data['members'] = array();
            foreach ($company_members as $key => $member) {
                $member_info['user_id'] = $member->id;
                $member_info['fullname'] = $member->fullname;
                $member_info['company_details'] = $this->points_model->get_company_details($member->parent_id);
                $member_info['temp'] = $this->points_model->get_company_summary_by_com_id($member->id, 'temp', $month, $end_date);
                $member_info['perm'] = $this->points_model->get_company_summary_by_com_id($member->id, 'perm', $month, $end_date);
                $member_info['excenge_amount'] = $this->points_model->get_total_excange_by_member_id($member->id, $month, $end_date);
                $data['members'][] = $member_info;
            }


            echo json_encode($data);
        }

    }

    public function get_company_point()
    {
        $user_id = $this->input->post('user_id');
        if ($this->authentication->is_signed_in()) {
            if ($user_id == "") {
                $user_id = $this->session->userdata('account_id');
            }
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

            $data['company_details'] = $this->points_model->get_company_details($user_id);

            $member_points = $this->points_model->get_member_point($user_id);

            echo json_encode($member_points);
        }

    }

    public function get_member_point()
    {
        $user_id = NULL;
        $company_id = $this->input->post('user_id') == "" ? NULL : $this->input->post('user_id');
        $member_id = $this->input->post('member_id') == "" ? NULL : $this->input->post('member_id');
        if ($this->authentication->is_signed_in()) {
            if ($user_id == "") {
                $user_id = $this->session->userdata('account_id');
            }
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

            // $data['company_details'] = $this->points_model->get_company_details($user_id);

            $member_points = $this->points_model->get_member_point($company_id);

            echo json_encode($member_points);
        }
    }

    public function get_user_point()
    {
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

            // $data['company_details'] = $this->points_model->get_company_details($user_id);

            $member_points = $this->points_model->get_user_point($data['account']->id);

            echo json_encode($member_points);
        }
    }

    public function get_shop_list_by_member()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'member_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('member_margin')) {
            redirect('account/account_profile');
        }


        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        $shop_list = $this->points_model->get_shop_margin($data['account']->id);

        echo json_encode($shop_list);
    }

    public function save_introduce()
    {
        $user_id = NULL;
        $email_from_name = "株式会社ジャコス";
        $email_from_email = "jofo@jacos.co.jp";
        $tracking_id = 'nonmenber';
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $user_id = $data['account']->id;
            if ($data['account']->tracking_id != '') {
                $tracking_id = $data['account']->tracking_id;
            }
            $email_from_name = $data['account_details']->fullname;
            $email_from_email = $data['account']->email;
        }

        $introduce_name = $this->input->post('introduce_name');
        $partner_contact = ($this->input->post('partner_contact') != "") ? $this->input->post('partner_contact') : NULL;
        $partner_email = ($this->input->post('partner_email') != "") ? $this->input->post('partner_email') : NULL;
        $str_array = array();
        $emails = array();
        for ($i = 0; $i < count($introduce_name); $i++) {
            if (!empty($introduce_name[$i]) && !empty($partner_contact[$i]) && !empty($partner_email[$i])) {
                $partner_data = array(
                    'intro_user_id' => $user_id,
                    'partner_name' => $introduce_name[$i],
                    'partner_contact' => $partner_contact[$i],
                    'partner_email' => $partner_email[$i]
                );
                $emails[] = $partner_email[$i];
                $str_array[] = $partner_data;


                $link = "https://jafa.dev.jacos.jp?refaral=" . $tracking_id;

                $params['subject'] = "激安サイトのご案内";
                $params['message'] = $this->load->view('account/customer_introduce_email', array(
                    'email_from_name' => $email_from_name,
                    'email_to_name' => $introduce_name[$i],
                    'reg_link' => anchor($link, "激安サイト", 'title="激安サイト", class="" style="padding: 10px;font-size: 22px;background-color: #007bff;border-color: #007bff;text-decoration: none; color: white; text-align: center; vertical-align: middle; cursor: pointer;border-radius: 5px; display: inline-block; font-weight: 400;" target="_blank"')
                ), TRUE);
                $params['resourceed_file'] = '';
                $params['recipient'] = $partner_email[$i];
                $this->points_model->send_email($params);
            }
        }

        $response = array();
        if (!empty($emails)) {
            // Load email library
            $params['subject'] = "激安サイトのご案内";
            $params['message'] = $this->load->view('account/sender_introduce_email', array(
                'email_rec_name' => $data['account']->fullname,
                'introduce_name' => $introduce_name
            ), TRUE);
            $params['resourceed_file'] = '';
            $params['recipient'] = array($data['account']->email);
            $this->points_model->send_email($params);

            $this->db->insert_batch('introduce_partner', $str_array);
            $response['success'] = 1;
            $response['data'] = $str_array;
        } else {
            $response['success'] = 0;
            $response['data'] = "エラーが発生しました";
        }
        echo json_encode($response);
    }

    public function send_email_smtp($params = array())
    {
        $params['subject'] = "Grameen Leave Email Test";
        $params['message'] = "Test email for Ghrm";
        $params['resourceed_file'] = '';
        $params['recipient'] = array('ahsanullah716@gmail.com', 'jacosahasan@gmail.com');
        print_r($this->points_model->send_email($params));
        // print_r($data);
    }

    public function get_user_partner()
    {
        $user_id = NULL;
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $user_id = $data['account']->id;
        }
        $partners = $this->db->where('intro_user_id', $user_id)->order_by('intro_id', 'desc')->get('introduce_partner')->result();
        echo json_encode($partners);
    }

    public function get_html()
    {
        $url = $this->input->post('item_url');
        $html = file_get_contents($url);
        echo $html;
    }

    public function members($user_id = NULL)
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }

        $company_members = $this->points_model->get_company_member($user_id);
        $data['company_details'] = $this->account_details_model->get_by_account_id($user_id);

        $members = array();
        foreach ($company_members as $key => $member) {
            $member_sum = $this->points_model->get_member_temp_sum($member->id);
            $member_info['user_id'] = $member->id;
            $member_info['fullname'] = $member->fullname;
            $member_info['total_salse_amount'] = $member_sum->item_sales_amount;
            $member_info['chalin_two'] = $member_sum->chalin_two;
            $member_info['shop_point'] = $member_sum->shop_point;
            $members[] = $member_info;
        }
        // $result = $this->db->where('parent_id', $user_id)->get('tbl_training_calendar')->result();
        // echo json_encode($members);
        $data['members'] = $members;

        $this->load->view('member_list', $data);
    }

    public function get_amazon_product_by_keyword($keyword = NULL)
    {
        // $keyword = $this->input->post('keyword');

        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";

        // Your Secret Key corresponding to the above ID, as taken from the Your Account page
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";

        // The region you are interested in
        $endpoint = "webservices.amazon.co.jp";

        $uri = "/onca/xml";


        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAJBOMU3LLPXXYHAUQ",
            "AssociateTag" => "jouene0f-22",
            // "AssociateTag" => "jafa-sei002-22",
            "SearchIndex" => "All",
            // "ResponseGroup" => "ItemAttributes",
            "ResponseGroup" => "ItemAttributes, SalesRank, ItemInfo.ExternalIds",
            "Keywords" => "$keyword"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key) . "=" . rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n" . $endpoint . "\n" . $uri . "\n" . $canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));

        // Generate the signed URL
        $request_url = 'http://' . $endpoint . $uri . '?' . $canonical_query_string . '&Signature=' . rawurlencode($signature);


        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request_url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
    }

    function http_response($url = NULL, $status = null, $wait = 3)
    {
        $jan_code = 'コカコーラ';
        $offset = 0;

        $request = "http://shopping.yahooapis.jp/ShoppingWebService/V1/php/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=" . urlencode($jan_code) . "&hits=50&offset=" . $offset . "&price_from=2&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D&type=all&condition=new";
        $response = file_get_contents($request);

        // $session = curl_init($request);

        // curl_setopt($session, CURLOPT_HEADER, false);
        // curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($session);
        // curl_close($session);
        print_r($response);
        exit();

        $time = microtime(true);
        $expire = $time + $wait;

        // we fork the process so we don't have to wait for a timeout
        // $pid = pcntl_fork();
        // if ($pid == -1) {
        //     die('could not fork');
        // } else if ($pid) {
        // we are the parent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        print_r($head);
        exit();
        if (!$head) {
            return FALSE;
        }

        if ($status === null) {
            if ($httpCode < 400) {
                return TRUE;
            } else {
                return FALSE;
            }
        } elseif ($status == $httpCode) {
            return TRUE;
        }

        return FALSE;
        pcntl_wait($status); //Protect against Zombie children
        // } else {
        //     // we are the child
        //     while(microtime(true) < $expire)
        //     {
        //     sleep(0.5);
        //     }
        //     return FALSE;
        // }
    }

    public function yahoo_api_by_keyword($jan_code, $start_from = 1, $results = 30, $sort = "-score")
    {

        // Yahoo Product api link by Keyword or JAN
        // API Version 1 is Stoped July 07, 2020 But notice 31 June 2020 stop
        // Stop Notice:  https://developer.yahoo.co.jp/changelog/2019-08-28-shopping222.html

        // $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=".urlencode($jan_code)."&hits=50&offset=".$offset."&price_from=2&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D&type=all&condition=new";
        $soft_info = $this->points_model->check_by(array('setting_name' => 'sort'), 'jafa_settings');
        $condition_info = $this->points_model->check_by(array('setting_name' => 'condition'), 'jafa_settings');

        // Yahoo version V3
        $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=" . urlencode($jan_code) . "&condition=" . $condition_info->setting_value . "&start=" . $start_from . "&results=" . $results . "&sort=" . urlencode($soft_info->setting_value);
        // $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?query=".urlencode($jan_code)."&start=".$start_from."&results=".$results."&sort=".urlencode($sort);
        // return $url
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        // print_r($resp);
        return $resp;
    }

    public function get_suggestion()
    {
        $keyword = $this->input->post('keyword');
        $xmlData = $this->get_amazon_product_by_keyword($keyword);
        $xml = simplexml_load_string($xmlData);
        $json = json_encode($xml);
        $xmlarray = json_decode($json, TRUE);
        $suggestions = $xmlarray['Items']['Item'];
        $arrayData = array();

        foreach ($suggestions as $key => $suggestion) {

            $jan = NULL;
            if (!empty($suggestion['ItemAttributes']['EAN'])) {
                $jan = $suggestion['ItemAttributes']['EAN'];
                $arrayData[] = array("label" => $suggestion['ItemAttributes']['Title'], "value" => $suggestion['ItemAttributes']['Title'], "jan" => $jan, "SalesRank" => $suggestion['SalesRank']);
            }


        }
        echo json_encode($arrayData);

    }

    public function get_yahoo_suggestion()
    {
        $keyword = $this->input->post('keyword');
        // $keyword = "マスク";
        $var = "0";
        $start_from = (int)1;
        $limit = 50;
        $sort = "-score";
        // $sort = "-review_count";
        $yahooData = array();
        $result = array();
        $totalResult = 0;
        try {
            $resData = $this->yahoo_api_by_keyword($keyword, $start_from, $limit, $sort);

            $yahooData = json_decode($resData);
            // print_r($yahooData);
            // exit();
            $totalResult = $yahooData->totalResultsReturned;
            $resultsAvailable = $yahooData->totalResultsAvailable;
            // print_r($yahooData);
            // exit();
            $arrayData = array();
            $minimum_list = 15;
            // Desing array for Autocomplete suggestion
            if ($totalResult > 0) {
                for ($i = 0; $i < $yahooData->totalResultsReturned; $i++) {
                    // Deny product if this keywords has in name
                    $yahoodata = array();
                    if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                        $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                    }
                    if (!empty($yahoodata)) {
                        $arrayData[] = $yahoodata;
                    }
                }

                if (count($arrayData) < $minimum_list && $resultsAvailable > 50) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 51, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }

                if (count($arrayData) < $minimum_list && $resultsAvailable > 100) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 101, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }

                if (count($arrayData) < $minimum_list && $resultsAvailable > 150) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 151, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }
                if (count($arrayData) < $minimum_list && $resultsAvailable > 200) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 201, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }
                if (count($arrayData) < $minimum_list && $resultsAvailable > 250) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 251, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }
                if (count($arrayData) < $minimum_list && $resultsAvailable > 300) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 301, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }
                if (count($arrayData) < $minimum_list && $resultsAvailable > 350) {
                    $yahooData = $this->yahoo_api_by_keyword($keyword, 351, $limit, $sort);
                    $yahooData = json_decode($yahooData);
                    $totalResult = $yahooData->totalResultsReturned;
                    for ($i = 0; $i < $totalResult; $i++) {
                        // Deny product if this keywords has in name
                        $yahoodata = array();
                        if ($yahooData->hits[$i]->janCode != '' || $yahooData->hits[$i]->isbn != "") {
                            $yahoodata = array("label" => $yahooData->hits[$i]->name, "value" => $yahooData->hits[$i]->name, "jan" => $yahooData->hits[$i]->janCode, "isbn" => $yahooData->hits[$i]->isbn, "keyword" => $keyword);
                        }
                        if (!empty($yahoodata)) {
                            $arrayData[] = $yahoodata;
                        }
                    }
                }

            } else {
                $arrayData = array();
            }


        } catch (Exception $e) {
            $arrayData = array();
        }
        echo json_encode(array_unique($arrayData, SORT_REGULAR));
        // for ($i=0; $i < 3; $i++) {
        // 	$data['increment'] = $i;
        // 	$data['offset'] = $offset;
        // 	$data['yahooData'] = $this->yahoo_api_by_keyword($keyword, $offset);
        // 	$offset += 50;
        // 	$allData[]= $data;
        // }
        // print_r($arrayData);
        // exit();
    }


    public function get_yahoo_suggestion22222()
    {
        $keyword = $this->input->post('keyword');
        // Get Yahoo product list by Keyword
        // $data['yahooData'] = array();
        $offset = 0;
        // $allData = array();
        // for ($i=0; $i < 3; $i++) {
        // 	$data['increment'] = $i;
        // 	$data['offset'] = $offset;
        // 	$data['yahooData'] = $this->yahoo_api_by_keyword($keyword, $offset);
        // 	$offset += 50;
        // 	$allData[]= $data;
        // }
        // print_r($allData);
        // exit();
        $yahooData = $this->yahoo_api_by_keyword($keyword, 0);
        $yahooData = json_decode($yahooData);
        $var = 0;
        $arrayData = array();
        // Desing array for Autocomplete suggestion
        for ($i = 0; $i < $yahooData->ResultSet->totalResultsReturned; $i++) {

            // Deny product if this keywords has in name
            $array = array('中古', 'ポイント', '送料');
            $yahoodata = array();
            if (!$this->strposa($yahooData->ResultSet->$var->Result->$i->Name, $array, 1)) {

                if ($yahooData->ResultSet->$var->Result->$i->JanCode != '' || $yahooData->ResultSet->$var->Result->$i->IsbnCode != "") {
                    // if (!empty($yahooData->ResultSet->$var->Result->Request->Query) && strpos($yahooData->ResultSet->$var->Result->$i->Name, $yahooData->ResultSet->$var->Result->Request->Query) == true) {
                    $yahoodata = array("label" => $yahooData->ResultSet->$var->Result->$i->Name, "value" => $yahooData->ResultSet->$var->Result->$i->Name, "jan" => $yahooData->ResultSet->$var->Result->$i->JanCode, "isbn" => $yahooData->ResultSet->$var->Result->$i->IsbnCode, "keyword" => $keyword);
                    // }
                }
                // elseif ($yahooData->ResultSet->$var->Result->$i->JanCode == '' && $yahooData->ResultSet->$var->Result->$i->IsbnCode != "") {
                // 	$yahoodata = array("label"=>$yahooData->ResultSet->$var->Result->$i->Name,"value"=>$yahooData->ResultSet->$var->Result->$i->Name, "jan" => $yahooData->ResultSet->$var->Result->$i->JanCode, "isbn" => $yahooData->ResultSet->$var->Result->$i->IsbnCode, "keyword" => $keyword);
                // }
            }
            if (!empty($yahoodata)) {
                $arrayData[] = $yahoodata;
            }
        }

        // print_r(array_unique($arrayData, SORT_REGULAR));
        // exit();
        // if (count(array_unique($arrayData, SORT_REGULAR)) {
        // 	# code...
        // }
        // $response_data['response'] = $arrayData;
        // $response_data['request'] = $keyword;

        // Send response to javascript
        echo json_encode(array_unique($arrayData, SORT_REGULAR));
    }

    function strposa($haystack, $needles = array(), $offset = 0)
    {
        $chr = array();
        foreach ($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) $chr[$needle] = $res;
        }
        if (empty($chr)) return false;
        return min($chr);
    }

    public function member_purchase_details($member_id = NULL, $month = NULL, $end_date = NULL)
    {
        $month = $month == 'null' ? NULL : $month;
        $end_date = $end_date == 'null' ? NULL : $end_date;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'purchase_list/' . $member_id));
        }
        if (empty($member_id)) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $member_id = $data['account']->id;
        } else {
            $data['account'] = $this->account_model->get_by_id($member_id);
            $data['account_details'] = $this->account_details_model->get_by_account_id($member_id);
        }
        // echo sprintf('%04d', 10);
        // exit();
        $data['member_purchase'] = $this->points_model->get_customer_purchase_list($member_id, $month, $end_date);
        $data['user_id'] = $member_id;
        $data['report_lenght'] = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
        if ($month == 'all') {
            $data['report_lenght'] = "すべてのレポート";
        } elseif (empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('1日') . '～' . date('m月末日', strtotime($month));
        } elseif (!empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('d日', strtotime($month)) . '～' . date('Y年の', strtotime($end_date)) . date('m月', strtotime($end_date)) . date('d日', strtotime($end_date));
        }

//         echo $this->db->last_query();
//         exit();
//         echo "<pre>"; print_r($data['account']);
//         exit();
        $this->load->view('point_list', $data);
    }

    public function giftcode_history($member_id = NULL, $month = NULL, $end_date = NULL)
    {
        $month = $month == 'null' ? NULL : $month;
        $end_date = $end_date == 'null' ? NULL : $end_date;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'purchase_list/' . $member_id));
        }
        if (empty($member_id)) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $member_id = $data['account']->id;
        } else {
            $data['account'] = $this->account_model->get_by_id($member_id);
            $data['account_details'] = $this->account_details_model->get_by_account_id($member_id);
        }
        // echo sprintf('%04d', 10);
        // exit();
        $data['giftcodes'] = $this->points_model->get_customer_giftcode_history($member_id, $month, $end_date);
        // echo $this->db->last_query();
        // print_r($data['giftcodes']);
        // exit();
        $data['user_id'] = $member_id;
        $data['report_lenght'] = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
        if ($month == 'all') {
            $data['report_lenght'] = "すべてのレポート";
        } elseif (empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('1日') . '～' . date('m月末日', strtotime($month));
        } elseif (!empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('d日', strtotime($month)) . '～' . date('Y年の', strtotime($end_date)) . date('m月', strtotime($end_date)) . date('d日', strtotime($end_date));
        }

        $this->load->view('admin/giftcode_history', $data);
    }

    public function exchange_history($month = NULL, $end_date = NULL)
    {
        $month = $month == 'null' ? NULL : $month;
        $end_date = $end_date == 'null' ? NULL : $end_date;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect(urlencode(base_url()));
        }

        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        $member_id = $data['account']->id;

        // echo sprintf('%04d', 10);
        // exit();
        $data['giftcodes'] = $this->points_model->get_customer_giftcode_history($member_id, $month, $end_date);
        // echo $this->db->last_query();
        // print_r($data['giftcodes']);
        // exit();
        $data['user_id'] = $member_id;
        $data['report_lenght'] = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
        if ($month == 'all') {
            $data['report_lenght'] = "すべてのレポート";
        } elseif (empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('1日') . '～' . date('m月末日', strtotime($month));
        } elseif (!empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('d日', strtotime($month)) . '～' . date('Y年の', strtotime($end_date)) . date('m月', strtotime($end_date)) . date('d日', strtotime($end_date));
        }

        $this->load->view('member/exchange_history', $data);
    }

    public function purchase_history($member_id = NULL, $month = NULL, $end_date = NULL)
    {
        $month = $month == 'null' ? NULL : $month;
        $end_date = $end_date == 'null' ? NULL : $end_date;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'purchase_list/' . $member_id));
        }
        if (empty($member_id)) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $member_id = $data['account']->id;
        } else {
            $data['account'] = $this->account_model->get_by_id($member_id);
            $data['account_details'] = $this->account_details_model->get_by_account_id($member_id);
        }
        // echo "<pre>"; print_r($data);
        // exit();
        $data['member_purchase'] = $this->points_model->get_customer_purchase_list($member_id, $month, $end_date);
        $data['user_id'] = $member_id;
        $data['report_lenght'] = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
        if ($month == 'all') {
            $data['report_lenght'] = "すべてのレポート";
        } elseif (empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('1日') . '～' . date('m月末日', strtotime($month));
        } elseif (!empty($end_date) && $month != 'all' && !empty($month)) {
            $data['report_lenght'] = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('d日', strtotime($month)) . '～' . date('Y年の', strtotime($end_date)) . date('m月', strtotime($end_date)) . date('d日', strtotime($end_date));
        }

        // echo $this->db->last_query();
        // exit();
        // echo "<pre>"; print_r($data['account']);
        // exit();
        $this->load->view('point_list', $data);
    }

    public function get_all_affiliate($keyword)
    {
        $amazon_data = $this->get_amazon_product_by_keyword($keyword);

        $amazon_array = simplexml_load_string($amazon_data, "SimpleXMLElement", LIBXML_NOCDATA);
        $affiResponse = array();

        if (!empty($amazon_array->Items->Item)) {
            if (count($amazon_array->Items->Item) > 0) {
                $resData = array();
                for ($i = 0; $i < count($amazon_array->Items->Item); $i++) {

                    $item = array();

                    $item['shop_name'] = "アマゾン ";
                    $item['product_name'] = $amazon_array->Items->Item[$i]->ItemAttributes->Title;
                    $item['barcode'] = $keyword;
                    $item['asin'] = $amazon_array->Items->Item[$i]->ASIN;
                    $item['product_image'] = $amazon_array->Items->Item[$i]->MediumImage->URL[0];
                    $item['small_image'] = $amazon_array->Items->Item[$i]->SmallImage->URL;
                    $item['merchen_name'] = "Amazonマーケットプレイス ";
                    // $item['merchant_name'] = $amazon_array->Items->Item[$i]->Offers->Offer->Merchant->Name;
                    $item['item_qty'] = 0;
                    $item['main_price'] = 0;
                    $item['price'] = $amazon_array->Items->Item[$i]->OfferSummary->LowestNewPrice->Amount;
                    $item['single_price'] = 0;
                    $item['real_price'] = 0;
                    $item['totalReview'] = 0;
                    $item['reviewAverage'] = 0;
                    $item['affiliateRate'] = 0;
                    $item['affiliatePoint'] = 0;
                    $item['chalinPoint'] = 0;
                    $item['itemUrl'] = $amazon_array->Items->Item[$i]->Offers->MoreOffersUrl;

                    $resData[] = $item;
                }
                array_push($affiResponse, $resData[0]);
            }
        }
        // echo json_encode($resData[0]);
        // exit();
        $yahooData = $this->server_yahoo_api($keyword);

        $ddata = json_decode($yahooData);
        $yahoo_data = array();
        foreach ($ddata->ResultSet as $key => $result) {

            if ($key == '0') {
                $yahoo_data[] = $result->Result;
            }

        }

        $yahoo_final = array();
        foreach ($yahoo_data[0] as $key => $value) {
            if (is_numeric($key)) {
                $yahoo_final[] = $value;
            }
        }
        $resData = array();
        $price = $yahoo_final[0]->Price->_value;
        $affiliatRate = $yahoo_final[0]->Affiliate->Rate;
        $shopPoint = ($price * $affiliatRate) / 100;
        $charinPoint = ($price * $affiliatRate) / 200;
        $item['shop_name'] = "ヤフー ";
        $item['product_name'] = $yahoo_final[0]->Name;
        $item['barcode'] = $keyword;
        $item['asin'] = $yahoo_final[0]->Code;
        $item['product_image'] = $yahoo_final[0]->Image->Medium;
        $item['small_image'] = $yahoo_final[0]->Image->Small;
        $item['merchen_name'] = $yahoo_final[0]->Store->Name;
        // $item['merchant_name'] = $amazon_array->Items->Item[$i]->Offers->Offer->Merchant->Name;
        $item['item_qty'] = 1;
        $item['main_price'] = $yahoo_final[0]->Price->_value;
        $item['price'] = $yahoo_final[0]->Price->_value;
        $item['single_price'] = $yahoo_final[0]->Price->_value;
        $item['real_price'] = $yahoo_final[0]->Price->_value;
        $item['totalReview'] = $yahoo_final[0]->Review->Count;
        $item['reviewAverage'] = $yahoo_final[0]->Review->Rate;
        $item['affiliateRate'] = $yahoo_final[0]->Affiliate->Rate;
        $item['affiliatePoint'] = $shopPoint;
        $item['chalinPoint'] = $charinPoint;
        $item['itemUrl'] = $yahoo_final[0]->Url;
        // $resData[] = $item;
        array_push($affiResponse, $item);
        echo json_encode($affiResponse);
        // echo json_encode($yahooData);

    }

    public function server_yahoo_api($jan_code = NULL)
    {
        if (empty($jan_code)) {
            $jan_code = $this->input->post('barcode');
        }

        // $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=".$jan_code."&hits=40&offset=0&price_from=2&sort=%2Bprice&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D";
        $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&query=" . $jan_code . "&hits=50&offset=0&price_from=2&condition=new&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D";
        // $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?appid=dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-&jan=".$jan_code."&hits=5&offset=0&price_from=2&sort=%2Bprice&affiliate_type=vc&affiliate_id=http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D";

        // create curl resource
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
    }

    public function save_product_size_unit($id = NULL)
    {
        $unit_name = $this->input->post('unit_name');
        $this->points_model->_table_name = 'product_unit_name';
        $this->points_model->_primary_key = 'unit_id';
        if (empty($id)) {
            $unit_name = $this->input->post('unit_name');
            // echo $unit_name;
            // exit();
            if ($unit_name != "") {
                $member_com_id = $this->points_model->save(array('unit_name' => $unit_name));
                $data['success'] = 1;
                $data['message'] = 'added';
            } else {
                $data['success'] = 0;
                $data['message'] = 'error';
            }
            echo json_encode($data);
        } else {
            $unit_name = $this->input->post('unit_name');
            if ($unit_name != "") {
                $member_com_id = $this->points_model->save(array('unit_name' => $unit_name), $id);
                $data['success'] = 1;
                $data['message'] = 'updated';
            } else {
                $data['success'] = 0;
                $data['message'] = 'error';
            }
            echo json_encode($data);
        }
    }

    public function get_product_size($id = NULL)
    {
        if (!empty($id)) {
            $unit_name = $this->db->where('unit_id', $id)->get('product_unit_name')->row();
            echo json_encode($unit_name);
        } else {
            $unit_name = $this->db->get('product_unit_name')->result();
            echo json_encode($unit_name);
        }
    }

    public function get_user_amazon_point()
    {
        $user_id = $this->session->userdata('account_id');
        $data = array();
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = 'member';
            }
            //echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            if ($data['user_info']->role_id == 1) {
                $data['temporary_point'] = $data['user_temp_points']->jafa_point;
                $data['permanent_point'] = ($data['user_perm_points']->jafa_point - $data['converted_point']->converted_point);
            } elseif ($data['user_info']->role_id == 2) {
                $data['temporary_point'] = $data['user_temp_points']->company_point;
                $data['permanent_point'] = ($data['user_perm_points']->company_point - $data['converted_point']->converted_point);
            } else {
                $data['temporary_point'] = $data['user_temp_points']->user_point;
                $data['permanent_point'] = ($data['user_perm_points']->user_point - $data['converted_point']->converted_point);
            }
            // print_r($data);
            // exit();
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }

        //print_r($data);
        echo json_encode($data);
    }

    public function get_user_amazon_point_detail($user_id = null)
    {
//        $data['user_info'] = $this->account_model->get_by_id($user_id);
        if ($user_id == NULL) {
            $user_id = $this->session->userdata('account_id');
        }
        $data = array();
        if ($this->authentication->is_signed_in()) {
            $data['user_info'] = $this->account_model->get_by_id($user_id);
//			print_r($data['user_info']);
//			exit();
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }
//        echo "<pre>";
//        print_r($data);
//        exit();
        $this->load->view('jacos_point_details/point_details_indivual', $data);

    }

    public function check_login()
    {
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            echo json_encode($data);
        } else {
            return false;
        }
    }

    public function kamitein_list()
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'kamitein_list'));
        }
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['company_list'] = $this->points_model->company_list();

        $this->load->view('admin/kamitein_list', $data);
    }

    // Audio to text function

    function audio_to_text($audioFile)
    {
        $content = file_get_contents($audioFile);

        # set string as audio content
        $audio = (new RecognitionAudio())
            ->setContent($content);
        # The audio file's encoding, sample rate and language
        $config = new RecognitionConfig([
            'encoding' => AudioEncoding::LINEAR16,
            'sample_rate_hertz' => 48000,
            'language_code' => 'ja-JP'
        ]);
        # Instantiates a client
        $client = new SpeechClient();
        # Detects speech in the audio file
        $response = $client->recognize($config, $audio);
        # Print most likely transcription
        $transcript = '';
        foreach ($response->getResults() as $result) {
            $alternatives = $result->getAlternatives();
            $mostLikely = $alternatives[0];
            $transcript .= $mostLikely->getTranscript();
        }
        return $transcript;
    }

    public function voice_to_text_google()
    {
        //print_r($_FILES); //this will print out the received name, temp name, type, size, etc.


        $size = $_FILES['audio_data']['size']; //the size in bytes
        $input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
        $output = $_FILES['audio_data']['name'] . ".wav"; //letting the client control the filename is a rather bad idea

        $config = array(
            'upload_path' => "./resource/audio/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "50480000",
            'file_name' => md5(date('Y-m-dh:s'))
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('audio_data')) {
            $data = array('file' => $this->upload->data());
            $audio_file_name_path = $data['file']['full_path'];

            $file = 'resource/audio/1.wav';
            // $file = 'audio/aad1ce259667773629e652626e958365.flac';
            $content = file_get_contents($file);

            # set string as audio content
            $audio = (new RecognitionAudio())
                ->setContent($content);
            # The audio file's encoding, sample rate and language
            $config = new RecognitionConfig([
                'encoding' => AudioEncoding::LINEAR16,
                'sample_rate_hertz' => 48000,
                'language_code' => 'ja-JP'
            ]);
            # Instantiates a client
            $client = new SpeechClient();
            # Detects speech in the audio file
            $response = $client->recognize($config, $audio);
            # Print most likely transcription
            $transcript = '';
            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                $mostLikely = $alternatives[0];
                $transcript .= $mostLikely->getTranscript();
            }
            echo $transcript;

            // $audio_content = $this->audio_to_text('resource/audio/15b1ad2a9c430b2496e4a196b0ef1906.wav');
            // echo json_encode(array('audiotext'=>$audio_content));
            // print_r($data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(array('error' => $error));
        }
        //exit();
        // print_r($_FILES);
        // exit();

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 1000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('audio_data')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            print_r($data);
            // $this->load->view('upload_success', $data);
        }
        //move the file from temp name to local folder using $output name
        // move_uploaded_file($input, $output)
        // $file_path = RES_DIR.'/1.wav';
        // $audito_text = $this->audio_to_text($output);
        // print_r($audito_text);
        // exit();
    }

    public function upload_referal_fee()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        $data['member_points'] = $this->points_model->get_member_point();
        // echo "<pre>"; print_r($member_points);
        // exit();
        $this->load->view('admin/upload_temporay_referal_fee', $data);
    }

    public function upload_permanent_referal_fee()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }
        $data['member_points'] = $this->points_model->get_member_point();
        // echo "<pre>"; print_r($member_points);
        // exit();
        $this->load->view('upload_permanent_referal_fee', $data);
    }

    public function save_referal_fee()
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'company_margine'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        if (isset($_POST["Import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                $file = fopen($filename, "r");
                $i = 0;
                $duplicateData = 0;
                //$dupData = 0;
                $newData = 0;
                $totalData = 0;
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i++;
                    $attributes['shop_id'] = $this->input->post('shop_id');
                    $continue = 1;

                    if ($attributes['shop_id'] == 1) {
                        $continue = 2;
                    }
                    $site_pernament_date = NULL;
                    if ($i > $continue) {
                        if ($attributes['shop_id'] == 1) {
                            if (count($getData) != 13) {
                                $message = "ファイル形式が無効です。";
                                $this->session->set_flashdata('log_data', array('message' => $message, 'error' => 1));
                                redirect('upload_referal_fee');
                            }
                            $tracking_id = $getData[4];
                            $product_name = $getData[1];
                            $order_amount = $getData[9];
                            $point_amount = $getData[11];
                            $order_date = date("Y-m-d H:i:s", strtotime($getData[5]));
                            $processMonth = date("m", strtotime($order_date)) + 2;
                            $processYear = date("Y", strtotime($order_date));
                            $time = strtotime("$getData[5]");
                            $perm_processing_date = date("Y-m-d 15:00:00", strtotime("+29 day", strtotime("$getData[5]")));
                            $site_pernament_date = date("Y-m-t", strtotime($processYear . '-' . $processMonth));

                            $status = 0;
                            $remarks = $getData[2];
                        } elseif ($attributes['shop_id'] == 2) {
                            // print_r(count($getData));
                            if (count($getData) != 14) {
                                $message = "ファイル形式が無効です。";
                                $this->session->set_flashdata('log_data', array('message' => $message, 'error' => 1));
                                redirect('upload_referal_fee');
                            }

                            $tracking_link = $getData[13];
                            $tracking_id = "nonmenber";
                            if (strpos($tracking_link, "tracking_id") !== false) {
                                $tracking_id = (explode("tracking_id=", $tracking_link));
                                $tracking_id = $tracking_id[1];
                            } else {
                                $tracking_id = "nonmenber";
                            }

                            $order_amount = $getData[7];
                            $point_amount = $getData[10];
                            $order_date = date("Y-m-d H:i:s", strtotime($getData[1]));
                            // Previous Processing Method
                            // $perm_processing_date = date("Y-m-d H:i:s", strtotime($getData[2]));
                            $perm_processing_date = date("Y-m-d 15:00:00", strtotime("+29 day", strtotime("$getData[1]")));
                            $site_pernament_date = date("Y-m-d", strtotime("+90 day", strtotime($order_date)));
                            $status = 0;
                            $remarks = $getData[3];
                        } else {
                            if (count($getData) != 15) {
                                $message = "ファイル形式が無効です。";
                                $this->session->set_flashdata('log_data', array('message' => $message, 'error' => 1));
                                redirect('upload_referal_fee');
                            }
                            $tracking_id = $getData[13];
                            $order_amount = filter_var($getData[10], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                            $point_amount = filter_var($getData[11], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                            $order_date = date("Y-m-d H:i:s", strtotime($getData[0]));

                            $perm_processing_date = date("Y-m-d 15:00:00", strtotime("+29 day", strtotime($getData[0])));
                            $site_pernament_date = date("Y-m-d", strtotime("+75 day", strtotime($order_date)));
                            $status = 0;
                            $remarks = $getData[14];
                        }

                        // Company User name and member tracking ID
                        $com_username = substr($tracking_id, 0, 5);
                        $member_tricking = substr($tracking_id, 5, 10);

                        $attributes['user_id'] = NULL;
                        $attributes['company_id'] = NULL;
                        $attributes['tracking_id'] = $tracking_id;
                        $attributes['product_name'] = $product_name;
                        $attributes['order_amount'] = $order_amount;
                        $attributes['point_amount'] = $point_amount;
                        $attributes['user_percentage'] = 0;
                        $attributes['company_percentage'] = 75;
                        $attributes['order_date'] = $order_date;
                        $attributes['perm_processing_date'] = $perm_processing_date;
                        $attributes['amazon_per_date'] = $site_pernament_date;
                        $attributes['status'] = $status;
                        $attributes['remarks'] = $remarks;
                        $attributes['uploaded_by'] = $data['account']->id;
                        $attributes['created_at'] = date("Y-m-d H:i:s");
                        $attributes['user_point'] = ($point_amount * 0) / 100;
                        $attributes['company_point'] = ($point_amount * 75) / 100;
                        $attributes['jafa_point'] = $point_amount - ($attributes['company_point'] + $attributes['user_point']);

                        //print_r($attributes);
                        //exit();

                        // Company Info by Username
                        $company_info = $this->points_model->check_by(array('username' => $com_username), 'a3m_account');

                        if (!empty($company_info)) {
                            $attributes['company_id'] = $company_info->id;

                            // Distribution Parcentige
                            $parcentage_info = $this->points_model->check_by(array('user_id' => $company_info->id), 'company_margin_distribution');

                            if (!empty($parcentage_info)) {
                                $attributes['user_percentage'] = $parcentage_info->member_mar;
                                $attributes['company_percentage'] = $parcentage_info->com_mar;
                            } else {
                                $attributes['user_percentage'] = 50;
                                $attributes['company_percentage'] = 25;
                            }

                            $jafa_margin = 100 - ($attributes['user_percentage'] + $attributes['company_percentage']);
                            $attributes['company_point'] = ($point_amount * $attributes['company_percentage']) / 100;
                            $attributes['user_point'] = ($point_amount * $attributes['user_percentage']) / 100;
                            $attributes['jafa_point'] = ($point_amount * $jafa_margin) / 100;

                            $member_info = $this->points_model->check_by(array('tracking_id' => $member_tricking, 'parent_id' => $company_info->id), 'a3m_account');

                            if (!empty($member_info)) {
                                $attributes['user_id'] = $member_info->id;
                            }
                        } else {
                            $attributes['company_id'] = 107;

                            // Distribution Parcentige
                            $parcentage_info = $this->points_model->check_by(array('user_id' => $attributes['company_id']), 'company_margin_distribution');

                            if (!empty($parcentage_info)) {
                                $attributes['user_percentage'] = $parcentage_info->member_mar;
                                $attributes['company_percentage'] = $parcentage_info->com_mar;
                            } else {
                                $attributes['user_percentage'] = 50;
                                $attributes['company_percentage'] = 25;
                            }

                            $jafa_margin = 100 - ($attributes['user_percentage'] + $attributes['company_percentage']);
                            $attributes['company_point'] = ($point_amount * $attributes['company_percentage']) / 100;
                            $attributes['user_point'] = ($point_amount * $attributes['user_percentage']) / 100;
                            $attributes['jafa_point'] = ($point_amount * $jafa_margin) / 100;

                            $member_info = $this->points_model->check_by(array('tracking_id' => $member_tricking, 'parent_id' => $parcentage_info->user_id), 'a3m_account');

                            if (!empty($member_info)) {
                                $attributes['user_id'] = $member_info->id;
                            }
                        }
                        if ($attributes['shop_id'] == 1) {
                            $existing_point = $this->points_model->check_by(array('remarks' => $attributes['remarks'], 'order_date' => $attributes['order_date'], 'shop_id' => $attributes['shop_id']), 'point');
                        } elseif ($attributes['shop_id'] == 2) {
                            $existing_point = $this->points_model->check_by(array('tracking_id' => $attributes['tracking_id'], 'order_date' => $attributes['order_date'], 'shop_id' => $attributes['shop_id']), 'point');
                        } else {
                            $existing_point = $this->points_model->check_by(array('tracking_id' => $attributes['tracking_id'], 'shop_id' => $attributes['shop_id'], 'remarks' => $remarks), 'point');
                        }
//						 print_r($attributes);
//						 exit();

                        if (!empty($existing_point)) {
                            $duplicateData++;
                            if ($existing_point->status != 1) {
                                $this->points_model->_table_name = "point"; //table name
                                $this->points_model->_primary_key = "point_id";
                                $this->points_model->save($attributes, $existing_point->point_id);
                            }
                        } else {
                            $newData++;
                            $this->points_model->_table_name = "point"; //table name
                            $this->points_model->_primary_key = "point_id";
                            $this->points_model->save($attributes);
                        }

                    }

                }
                fclose($file);
                $totalData = ($duplicateData + $newData);
                $message = "Total Data: $totalData, Duplicate Data: $duplicateData and New Data: $newData";
                $this->session->set_flashdata('log_data', array('message' => $message, 'error' => 0));

                redirect('upload_referal_fee');
            }
        }
    }

    public function setting_point_sharing()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'points'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('retrieve_roles')) {
            redirect('account/account_profile');
        }

        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        $data['member_companies'] = $this->points_model->get_company();

//        echo '<pre>';
//        print_r($data);
//        exit();
        $this->load->view('admin/setting_point_sharing', $data);
    }


    public function get_setting_point_sharing()
    {
        $company_list = $this->points_model->company_list();
        // print_r($company_list);
        // exit();
        $company_summary = array();
        foreach ($company_list as $key => $company) {
            $company_total = $this->points_model->get_summary_by_com_id($company->user_id);

            $item_sales_amount = $company_total->item_sales_amount;
            $chalin_two = $company_total->chalin_two;
            if ($item_sales_amount == NULL) {
                $item_sales_amount = 0;
            }
            if ($chalin_two == NULL) {
                $chalin_two = 0;
            }
            // echo $chalin_two;
            // exit();
            $sum_data['item_sales_amount'] = $item_sales_amount;
            $sum_data['chalin_two'] = $chalin_two;
            $sum_data['user_id'] = $company->user_id;
            $sum_data['company_name'] = $company->company_name;
            $sum_data['com_mar'] = $company->com_mar == NULL ? 0 : $company->com_mar;
            $sum_data['member_mar'] = $company->member_mar == NULL ? 0 : $company->member_mar;
            $sum_data['service_charge'] = $company->service_charge == NULL ? 0 : $company->service_charge;
            $sum_data['major_company'] = $company->major_company_jacos;
            $sum_data['role_name'] = $company->role_name;

            $company_summary['all_company'][] = $sum_data;
        }

        // echo "<pre>"; print_r($company_summary['all_company']);
        // exit();
        $company_summary['jacos'] = $this->points_model->jacos_summary();

        // echo $this->db->last_query();
        echo json_encode($company_summary);
    }

    public function download_member_point($company_id, $month = NULL, $end_date = NULL)
    {
        $user_id = $company_id;
        $end_date = $end_date == 'null' ? NULL : $end_date;
        if ($this->authentication->is_signed_in()) {
            $month2 = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
            if (empty($month)) {
                $month2 = date('Y年の') . date('m月') . date('1日') . '～' . date('m月末日');
            } elseif (!empty($month) && $month == 'all') {
                $month2 = 'すべてのレポート';
            } elseif (!empty($month) && empty($end_date)) {
                $month2 = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('1日') . '～' . date('m月末日', strtotime($month));
            } elseif (!empty($month) && !empty($end_date)) {
                $month2 = date('Y年の', strtotime($month)) . date('m月', strtotime($month)) . date('d日', strtotime($month)) . '～' . date('Y年の', strtotime($end_date)) . date('m月', strtotime($end_date)) . date('d日', strtotime($end_date));
            }

            $period = $month2;

            $data['company_details'] = $this->points_model->get_company_details($company_id);

            $company_members = $this->points_model->get_company_member($company_id);
            $data['members'] = array();
            foreach ($company_members as $key => $member) {
                // $member_info['member_id'] = $member->id;
                $member_info['fullname'] = $member->fullname;
                $temp = $this->points_model->get_company_summary_by_com_id($member->id, 'temp', $month, $end_date);
                $perm = $this->points_model->get_company_summary_by_com_id($member->id, 'perm', $month, $end_date);

                $excenge_amount = $this->points_model->get_total_excange_by_member_id($member->id, $month, $end_date)->amount;

                $member_info['temp_order_amount'] = $temp->order_amount == NULL ? 0 : number_format($temp->order_amount);
                $member_info['perm_order_amount'] = $perm->order_amount == NULL ? 0 : number_format($perm->order_amount);

                $member_info['temp_point_amount'] = $temp->point_amount == NULL ? 0 : number_format($temp->point_amount);
                $member_info['perm_point_amount'] = $perm->point_amount == NULL ? 0 : number_format($perm->point_amount);

                $member_info['temp_company_point'] = $temp->company_point == NULL ? 0 : number_format(floor($temp->company_point));
                $member_info['perm_company_point'] = $perm->company_point == NULL ? 0 : number_format(floor($perm->company_point));

                $member_info['temp_user_point'] = $temp->user_point == NULL ? 0 : number_format(floor($temp->user_point));
                $member_info['perm_user_point'] = $perm->user_point == NULL ? 0 : number_format(floor($perm->user_point));
                $member_info['excenge_amount'] = $excenge_amount == NULL ? 0 : number_format($excenge_amount);
                // $member_info['balance'] = number_format(($perm->user_point-$excenge_amount));
                $member_info['temp_total_company_point'] = number_format(floor($temp->company_point) + floor($temp->user_point));
                $member_info['perm_total_company_point'] = number_format(floor($perm->company_point) + floor($perm->user_point));
                $member_info['temp_jafa_point'] = number_format($temp->point_amount - (floor($temp->company_point) + floor($temp->user_point)));
                $member_info['perm_jafa_point'] = ($perm->point_amount - (floor($perm->company_point) + floor($perm->user_point)));
                // $member_info['balance'] = ($member_info['perm_user_point']-$member_info['excenge_amount']);
                $data['members'][] = $member_info;
            }

            // print_r($data['members']);
            // exit();

            // Sub totals
            $footer['name'] = "計";
            $footer['sub_temp_order_amount'] = 0;
            $footer['sub_per_porder_amount'] = 0;
            $footer['sub_temp_point'] = 0;
            $footer['sub_per_point'] = 0;
            $footer['sub_temp_company_point'] = 0;
            $footer['sub_per_company_point'] = 0;
            $footer['sub_temp_member_point'] = 0;
            $footer['sub_per_member_point'] = 0;
            $footer['sub_exchange_amount'] = 0;
            // $footer['sub_balance'] = 0;

            $footer['sub_temp_total_company_point'] = 0;
            $footer['sub_per_total_company_point'] = 0;

            $footer['sub_temp_jafa_point'] = 0;
            $footer['sub_per_jafa_point'] = 0;

            //
            $this->load->helper('download');
            $file_name = $data['company_details']->fullname . 'MembersPoint.csv';
            // Build the headers to push out the file properly.
            header('Content-Description: File Transfer');
            header('Content-Type: application/ms-excel');
            header('Content-Disposition: attachment; filename=' . $file_name);


            $fp = fopen('php://output', 'w');
            $company_name = array("加盟企業名：", $data['company_details']->fullname);
            $period_time = array("期間", $period);
            // $headers = array("会員名", "メールアドレス", "加盟企業分", "会員分", "ジャコス分", "リンク");
            $headers = array("会員名", "商品売上金額.未確定", "商品売上金額.確定", "チャリン２.未確定", "チャリン２.確定", "加盟企業.未確定", "加盟企業.確定", "会員計.未確定	", "会員計.確定", "会員計.交換", "支払計.未確定", "支払計.確定	", "当社粗利.未確定", "当社粗利.確定");

            fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($fp, $company_name);
            fputcsv($fp, $period_time);
            fputcsv($fp, $headers);
            foreach ($data['members'] as $user) {
                $footer['sub_temp_order_amount'] += intval(str_replace(',', '', $user['temp_order_amount']));
                $footer['sub_per_porder_amount'] += intval(str_replace(',', '', $user['perm_order_amount']));
                $footer['sub_temp_point'] += intval(str_replace(',', '', $user['temp_point_amount']));
                $footer['sub_per_point'] += intval(str_replace(',', '', $user['perm_point_amount']));
                $footer['sub_temp_company_point'] += intval(str_replace(',', '', $user['temp_company_point']));
                $footer['sub_per_company_point'] += intval(str_replace(',', '', $user['perm_company_point']));
                $footer['sub_temp_member_point'] += intval(str_replace(',', '', $user['temp_user_point']));
                $footer['sub_per_member_point'] += intval(str_replace(',', '', $user['perm_user_point']));
                $footer['sub_exchange_amount'] += intval(str_replace(',', '', $user['excenge_amount']));
                // $footer['sub_balance'] += intval(str_replace(',', '', $user['balance']));

                $footer['sub_temp_total_company_point'] += intval(str_replace(',', '', $user['temp_total_company_point']));
                $footer['sub_per_total_company_point'] += intval(str_replace(',', '', $user['perm_total_company_point']));

                $footer['sub_temp_jafa_point'] += intval(str_replace(',', '', $user['temp_jafa_point']));
                $footer['sub_per_jafa_point'] += intval(str_replace(',', '', $user['perm_jafa_point']));

                fputcsv($fp, $user);
            }
            $footer['sub_temp_order_amount'] = number_format($footer['sub_temp_order_amount']);
            $footer['sub_per_porder_amount'] = number_format($footer['sub_per_porder_amount']);
            $footer['sub_temp_point'] = number_format($footer['sub_temp_point']);
            $footer['sub_per_point'] = number_format($footer['sub_per_point']);
            $footer['sub_temp_company_point'] = number_format($footer['sub_temp_company_point']);
            $footer['sub_per_company_point'] = number_format($footer['sub_per_company_point']);
            $footer['sub_temp_member_point'] = number_format($footer['sub_temp_member_point']);
            $footer['sub_per_member_point'] = number_format($footer['sub_per_member_point']);
            $footer['sub_exchange_amount'] = number_format($footer['sub_exchange_amount']);
            // $footer['sub_balance'] = number_format($footer['sub_balance']);

            $footer['sub_temp_total_company_point'] = number_format($footer['sub_temp_total_company_point']);
            $footer['sub_per_total_company_point'] = number_format($footer['sub_per_total_company_point']);

            $footer['sub_temp_jafa_point'] = number_format($footer['sub_temp_jafa_point']);
            $footer['sub_per_jafa_point'] = number_format($footer['sub_per_jafa_point']);
            fputcsv($fp, $footer);
            fclose($fp);
        } else {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'main_controller/download_member_point/' . $user_id . '/' . $period . '/' . $end_date));
        }
    }

    public function download_member_information($company_id)
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'points'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('retrieve_roles')) {
            redirect('account/account_profile');
        }
        $company_details = $this->points_model->get_company_details($company_id);
        $company_members = $this->points_model->get_company_member($company_id);
        // echo "<pre>"; print_r($company_members);
        // exit();
        $headers = array("加盟企業名", "会員名", "メールアドレス", "携帯電話", "会員コード");
        $this->load->helper('download');
        $file_name = $company_details->fullname . 'MembersInfo.csv';
        // Build the headers to push out the file properly.
        header('Content-Description: File Transfer');
        header('Content-Type: application/ms-excel');
        header('Content-Disposition: attachment; filename=' . $file_name);


        $fp = fopen('php://output', 'w');
        fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $headers);
        $data = array();
        foreach ($company_members as $key => $member) {
            $data['comapny_name'] = $company_details->fullname;
            $data['member_name'] = $member->fullname;
            $data['member_email'] = $member->email;
            $data['member_username'] = $member->username;
            $data['member_tracking'] = $member->company_tracking . $member->member_tracking;
            fputcsv($fp, $data);
        }

        fclose($fp);
    }

    public function live_jancode()
    {
        $data = array();
        $referal = $this->input->get('refaral');
        $data['tracking_id'] = "";
        // $data['charin_parcentage'] = array();
        $default_parcentage = $this->db->where('user_id', 32)->get('company_margin_distribution')->row();
        $data['charin_pint'] = $default_parcentage->member_mar;
        if (!empty($referal)) {
            $data['referal_info'] = $this->account_model->get_by_username_email($referal);
            $default_parcentage = $this->db->where('user_id', $data['referal_info']->id)->get('company_margin_distribution')->row();
            if (!empty($default_parcentage)) {
                $data['charin_pint'] = $default_parcentage->member_mar;
            } else {
                $data['charin_pint'] = 0;
            }

        }
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
            $data['account_role'] = $this->account_model->get_by_username_email($data['account']->username);
            if (empty($data['account']->parent_id)) {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->id)->get('company_margin_distribution')->row();
                if (!empty($data['charin_parcentage'])) {
                    // $data['charin_pint'] = $data['charin_parcentage']->com_mar;
                    $data['charin_pint'] = $data['charin_parcentage']->member_mar;
                }
            } else {
                $data['charin_parcentage'] = $this->db->where('user_id', $data['account']->parent_id)->get('company_margin_distribution')->row();
                $data['charin_pint'] = $data['charin_parcentage']->member_mar;
            }

            $parent_trking = '';
            if (strlen($data['account']->tracking_id) > 5) {
                $parent_trking = 'jacos';
            }

            if ($data['account']->parent_id) {
                $data['parent_info'] = $this->account_model->get_by_id($data['account']->parent_id);
                $parent_trking = $data['parent_info']->tracking_id;
            }
            if (empty($data['account']->tracking_id)) {
                $data['tracking_id'] = 'jacos';
            } else {
                $data['tracking_id'] = $parent_trking . $data['account']->tracking_id;
            }
        }

        $this->load->view('compare', $data);
    }

    public function convirte_amazon_point()
    {
        if ($this->authentication->is_signed_in()) {
            $data['conver_point'] = $this->input->post('req_conver');
            $data['status'] = 1;
            $data['user_info'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['remaint_permanent_point'] = 0;
            $point_info = $this->get_point_details($data['user_info']->id);
            if ($point_info['permanent_point'] >= $data['conver_point']) {
                // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                //    $charactersLength = strlen($characters);
                //    $randomString = '';
                //    for ($i = 0; $i < 10; $i++) {
                //        $randomString .= $characters[rand(0, $charactersLength - 1)];
                //    }
                // return $randomString;
                $number_of_card = ($data['conver_point'] / 500);
                $gift_codes = $this->giftcode_model->get_new_code($data['user_info']->id, $number_of_card);
                // $this->points_model->check_by(array('user_id' => NULL, 'converted_point' => $data['conver_point']), 'jafa_gift_code');
                if (!empty($gift_codes)) {
                    // $insert_data['user_id'] = $data['user_info']->id;
                    // $insert_data['status'] = 1;
                    // $insert_data['use_date'] = date('Y-m-d H:i:s');
                    // $this->points_model->_table_name = 'jafa_gift_code';
                    //   	$this->points_model->_primary_key = 'gift_id';
                    //  		$id = $this->points_model->save($insert_data, $gift_code_info->gift_id);

                    $data['remaint_permanent_point'] = floor(($point_info['permanent_point'] - $data['conver_point']));
                    $this->email_gift_code($data['user_info'], $gift_codes, $data['conver_point'], $data['remaint_permanent_point']);
                } else {
                    $data['remaint_permanent_point'] = floor(($point_info['permanent_point']));
                }
            }
        } else {
            $data['status'] = 0;
            $data['remaint_permanent_point'] = 0;
            $data['user_info'] = array();
        }
        echo json_encode($data);
    }

    public function get_point_details($user_id)
    {
        $user_info = $this->account_model->get_by_id($user_id);
        $user_type = 'member';
        if ($user_info->role_id == 1) {
            $user_type = 'admin';
        } elseif ($user_info->role_id == 2) {
            $user_type = 'company';
        } else {
            $user_type = "member";
        }
        $data['user_temp_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
        $data['user_perm_points'] = $this->points_model->get_company_summary_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
        $data['temporary_point'] = 0;
        $data['permanent_point'] = 0;
        $data['converted_point'] = $this->points_model->get_converted_point_total($user_info->id);
        if ($user_info->role_id == 1) {
            $data['temporary_point'] = $data['user_temp_points']->jafa_point;
            $data['permanent_point'] = ($data['user_perm_points']->jafa_point - $data['converted_point']->converted_point);
        } elseif ($user_info->role_id == 2) {
            $data['temporary_point'] = $data['user_temp_points']->company_point;
            $data['permanent_point'] = ($data['user_perm_points']->company_point - $data['converted_point']->converted_point);
        } else {
            $data['temporary_point'] = $data['user_temp_points']->user_point;
            $data['permanent_point'] = ($data['user_perm_points']->user_point - $data['converted_point']->converted_point);
        }
        return $data;
    }


    public function gift_code_list()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'gift_codes'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('retrieve_roles')) {
            redirect('account/account_profile');
        }


        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        // $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

        $data['gift_codes'] = $this->points_model->get_gift_code();
        // print_r($data['gift_codes']);
        // exit();
        $this->load->view('admin/gift_code', $data);
    }

    public function email_gift_code($user_info, $gift_codes, $conver_point, $remaint_permanent_point)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.jacos.co.jp',
            'smtp_port' => 587,
            'smtp_user' => 'no-reply@jacos.co.jp',
            'smtp_pass' => 'hm&wKy7q',
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        // Send reset password email
        $this->email->from('no-reply@jacos.co.jp', "ジャコス会社");
        $this->email->to($user_info->email);
        $this->email->subject("JAFA Amazon ギフト券");
        $this->email->message($this->load->view('admin/gift_code_email', array(
            'user_info' => $user_info,
            'gift_codes' => $gift_codes,
            'remaining_point' => $remaint_permanent_point,
            'conver_point' => $conver_point,
            'giftcode_user_menual_link' => anchor('http://www.amazon.co.jp/giftcard/use', 'www.amazon.co.jp/giftcard/use')), TRUE));
        if ($this->email->send()) {
            return true;
        } else {
            return false;
            echo $this->email->print_debugger();
        }
        return;
    }

    function searchItems($keyword = NULL, $order_by = "Price:LowToHigh")
    {
        $config = new Configuration();


        if (empty($keyword)) {
            $keyword = $this->input->post('barcode');
        }

        $tracking_id = "nonmenber-22";
        // $parent_trking = 'jacos';
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            if ($data['account']->parent_id != "" || $data['account']->role_id == 2) {
                if ($data['account']->role_id == 2) {
                    $first_member_of_company = $this->db->where('parent_id', $data['account']->id)->order_by('tracking_id', 'ASC')->get('a3m_account')->row();
                    $tracking_id = $data['account']->tracking_id . $first_member_of_company->tracking_id . "-22";
                } else {
                    $parent_info = $this->account_model->get_by_id($data['account']->parent_id);
                    $parent_trking = $parent_info->tracking_id;
                    $tracking_id = $parent_trking . $data['account']->tracking_id . "-22";
                }
            }
        }
        /*
	     * Add your credentials
	     * Please add your access key here
	     */
        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";


        $config->setAccessKey($access_key_id);
        # Please add your secret key here
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";
        $config->setSecretKey($secret_key);

        # Please add your partner tag (store/tracking id) here
        // $tracking_id = "nonmenber-22";
        $partnerTag = $tracking_id;

        /*
	     * PAAPI host and region to which you want to send request
	     * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
	     */
        $endpoint = "webservices.amazon.co.jp";
        $config->setHost($endpoint);
        $config->setRegion('us-west-2');

        $apiInstance = new DefaultApi(
        /*
	     * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
	     * This is optional, `GuzzleHttp\Client` will be used as default.
	     */
            new GuzzleHttp\Client(), $config);

        # Request initialization

        # Specify keywords

        // $keyword = "4902102072625";

        /*
	     * Specify the category in which search request is to be made
	     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/use-cases/organization-of-items-on-amazon/search-index.html
	     */
        $searchIndex = "All";

        # Specify item count to be returned in search result
        $itemCount = 5;

        /*
	     * Choose resources you want from SearchItemsResource enum
	     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/search-items.html#resources-parameter
	     */

        // const ITEM_INFOTITLE = 'ItemInfo.Title';
        // const OFFERSLISTINGSPRICE = 'Offers.Listings.Price';
        $resources = array('ItemInfo.Title', 'ItemInfo.ManufactureInfo', 'ItemInfo.ProductInfo', 'ItemInfo.ExternalIds', 'Offers.Listings.Price', 'BrowseNodeInfo.BrowseNodes', 'BrowseNodeInfo.BrowseNodes.SalesRank', 'BrowseNodeInfo.WebsiteSalesRank', 'BrowseNodeInfo.BrowseNodes.Ancestor', 'Images.Primary.Small', 'Images.Primary.Medium', 'Images.Primary.Large', 'Offers.Listings.MerchantInfo', 'Offers.Summaries.LowestPrice', 'Offers.Listings.LoyaltyPoints.Points', 'Offers.Summaries.OfferCount', 'Offers.Listings.Condition', 'Offers.Listings.DeliveryInfo.IsFreeShippingEligible');

        # Forming the request
        $searchItemsRequest = new SearchItemsRequest();
        $searchItemsRequest->setSearchIndex($searchIndex);
        $searchItemsRequest->setCondition("New");
        $searchItemsRequest->setMinPrice(20);
        $searchItemsRequest->setSortBy($order_by);
        // $searchItemsRequest->setSortBy("Featured");
        $searchItemsRequest->setKeywords($keyword);
        $searchItemsRequest->setItemCount($itemCount);
        $searchItemsRequest->setPartnerTag($partnerTag);
        $searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
        $searchItemsRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $searchItemsRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            echo "Error forming the request", PHP_EOL;
            foreach ($invalidPropertyList as $invalidProperty) {
                echo $invalidProperty, PHP_EOL;
            }
            return;
        }

        # Sending the request
        try {

            $searchItemsResponse = $apiInstance->searchItems($searchItemsRequest);

            # Parsing the response
            if ($searchItemsResponse->getSearchResult() != null) {
                echo $searchItemsResponse->getSearchResult();
            }
            if ($searchItemsResponse->getErrors() != null) {
                $data['TotalResultCount'] = 0;
                $data['products'] = $searchItemsResponse->getSearchResult();
                $data['error_positin'] = 'Printing first error object from list of errors';
                $data['error_code'] = $searchItemsResponse->getErrors()[0]->getCode();
                $data['error_message'] = $searchItemsResponse->getErrors()[0]->getMessage();
                $data['errors'] = array();
                $data['error_body'] = NULL;

            }
        } catch (ApiException $exception) {
            $data['TotalResultCount'] = 0;
            $data['products'] = NULL;
            $data['error_positin'] = 'Error calling PA-API 5.0!';
            $data['error_code'] = $exception->getCode();
            $data['error_message'] = $exception->getMessage();
            $data['errors'] = array();
            $data['error_body'] = NULL;


            // echo "Error calling PA-API 5.0!", PHP_EOL;
            // echo "HTTP Status Code: ", $exception->getCode(), PHP_EOL;
            // echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            if ($exception->getResponseObject() instanceof ProductAdvertisingAPIClientException) {
                // $errors = $exception->getResponseObject()->getErrors();
                $data['errors'] = $exception->getResponseObject()->getErrors();
                // foreach ($errors as $error) {
                //     echo "Error Type: ", $error->getCode(), PHP_EOL;
                //     echo "Error Message: ", $error->getMessage(), PHP_EOL;
                // }
            } else {
                // echo "Error response body: ", $exception->getResponseBody(), PHP_EOL;
                $data['error_body'] = $exception->getResponseBody();
            }
            echo json_encode($data);
        } catch (Exception $exception) {
            // echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            $data['TotalResultCount'] = 0;
            $data['products'] = NULL;
            $data['error_positin'] = 'Error Exception calling PA-API 5.0!';
            $data['error_code'] = NULL;
            $data['error_message'] = $exception->getMessage();
            $data['errors'] = array();
            $data['error_body'] = NULL;
            echo json_encode($data);
        }
    }

    function amazon_suggestion()
    {
        $keyword = $this->input->post('keyword');

        // $keyword = NULL,
        // $order_by = "Price:LowToHigh";
        $order_by = "Relevance";
        $itemCount = 10;
        $pageCount = 1;
        $condition = "Any";
        $soft_info = $this->points_model->check_by(array('setting_name' => 'sort'), 'jafa_settings');
        $condition_info = $this->points_model->check_by(array('setting_name' => 'condition'), 'jafa_settings');

        if (!empty($soft_info)) {
            $order_by = $soft_info->setting_value;
        }

        if (!empty($condition_info)) {
            $condition = $condition_info->setting_value;
        }
        $amazon_data = $this->get_amazon_suggestion($keyword, $itemCount, $pageCount, $order_by, $condition);

        $amazon_data = json_decode($amazon_data,true);

        $totalResult = $amazon_data->TotalResultCount;
        //print_r($totalResult);
        // $resultsAvailable = $yahooData->totalResultsAvailable;

        $arrayData = array();
        $minimum_list = 15;
        // Desing array for Autocomplete suggestion
        if ($totalResult > 0) {
            for ($i = 0; $i < $totalResult; $i++) {

                // Deny product if this keywords has in name
                $amazon_result = array();
                if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds)) {
                    if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs) || !empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                        $product_name = $amazon_data->Items[$i]->ItemInfo->Title->DisplayValue;
                        $jan = "";
                        $isbn = "";
                        if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs)) {
                            $jan = $amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs->DisplayValues[0];
                        } elseif (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                            $isbn = $amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs->DisplayValues[0];
                        }

                        $amazon_result = array("label" => $product_name, "value" => $product_name, "jan" => $jan, "isbn" => $isbn, "keyword" => $keyword);
                    }

                }
                if (!empty($amazon_result)) {
                    $arrayData[] = $amazon_result;
                }
            }

            if (count($arrayData) < $minimum_list && $totalResult > 10) {
                $amazon_data = $this->get_amazon_suggestion($keyword, 10, 2, $order_by);
                $amazon_data = json_decode($amazon_data);
                $totalResult = $amazon_data->TotalResultCount;

                for ($i = 0; $i < $totalResult; $i++) {
                    // Deny product if this keywords has in name
                    $amazon_result = array();
                    if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds)) {
                        if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs) || !empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                            $product_name = $amazon_data->Items[$i]->ItemInfo->Title->DisplayValue;
                            $jan = "";
                            $isbn = "";
                            if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs)) {
                                $jan = $amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs->DisplayValues[0];
                            } elseif (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                                $isbn = $amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs->DisplayValues[0];
                            }

                            $amazon_result = array("label" => $product_name, "value" => $product_name, "jan" => $jan, "isbn" => $isbn, "keyword" => $keyword);
                        }

                    }
                    if (!empty($amazon_result)) {
                        $arrayData[] = $amazon_result;
                    }
                }
            }
            if (count($arrayData) < $minimum_list && $totalResult > 20) {
                $amazon_data = $this->get_amazon_suggestion($keyword, 10, 3, $order_by);
                $amazon_data = json_decode($amazon_data);
                $totalResult = $amazon_data->TotalResultCount;

                for ($i = 0; $i < $totalResult; $i++) {
                    // Deny product if this keywords has in name
                    $amazon_result = array();
                    if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds)) {
                        if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs) || !empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                            $product_name = $amazon_data->Items[$i]->ItemInfo->Title->DisplayValue;
                            $jan = "";
                            $isbn = "";
                            if (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs)) {
                                $jan = $amazon_data->Items[$i]->ItemInfo->ExternalIds->EANs->DisplayValues[0];
                            } elseif (!empty($amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs)) {
                                $isbn = $amazon_data->Items[$i]->ItemInfo->ExternalIds->ISBNs->DisplayValues[0];
                            }

                            $amazon_result = array("label" => $product_name, "value" => $product_name, "jan" => $jan, "isbn" => $isbn, "keyword" => $keyword);
                        }

                    }
                    if (!empty($amazon_result)) {
                        $arrayData[] = $amazon_result;
                    }
                }
            }

//            print_r($arrayData,SORT_REGULAR);
//            exit();

            echo json_encode(array_unique($arrayData, SORT_REGULAR));
        }

    }

    public function get_amazon_suggestion($keyword, $itemCount = 10, $pageCount = 1, $order_by = "Relevance", $condition = 'Any')
    {
        $config = new Configuration();

        if (empty($keyword)) {
            $keyword = $this->input->post('barcode');
        }

        $tracking_id = "nonmenber-22";
        // $parent_trking = 'jacos';

        /*
         * Add your credentials
         * Please add your access key here
         */
        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";


        $config->setAccessKey($access_key_id);
        # Please add your secret key here
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";
        $config->setSecretKey($secret_key);

        # Please add your partner tag (store/tracking id) here
        // $tracking_id = "nonmenber-22";
        $partnerTag = $tracking_id;



        /*
         * PAAPI host and region to which you want to send request
         * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
         */
        $endpoint = "webservices.amazon.co.jp";
        $config->setHost($endpoint);
        $config->setRegion('us-west-2');

        $apiInstance = new DefaultApi(
        /*
         * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
         * This is optional, `GuzzleHttp\Client` will be used as default.
         */
            new GuzzleHttp\Client(), $config);

        # Request initialization

        # Specify keywords

        // $keyword = "4902102072625";

        /*
         * Specify the category in which search request is to be made
         * For more details, refer: https://webservices.amazon.com/paapi5/documentation/use-cases/organization-of-items-on-amazon/search-index.html
         */
        $searchIndex = "All";

        # Specify item count to be returned in search result
        $itemCount = $itemCount;

        /*
         * Choose resources you want from SearchItemsResource enum
         * For more details, refer: https://webservices.amazon.com/paapi5/documentation/search-items.html#resources-parameter
         */

        // const ITEM_INFOTITLE = 'ItemInfo.Title';
        // const OFFERSLISTINGSPRICE = 'Offers.Listings.Price';
        $resources = array('ItemInfo.Title', 'ItemInfo.ManufactureInfo', 'ItemInfo.ProductInfo', 'ItemInfo.ExternalIds', 'Offers.Listings.Price', 'BrowseNodeInfo.BrowseNodes', 'BrowseNodeInfo.BrowseNodes.SalesRank', 'BrowseNodeInfo.WebsiteSalesRank', 'BrowseNodeInfo.BrowseNodes.Ancestor', 'Images.Primary.Small', 'Images.Primary.Medium', 'Images.Primary.Large', 'Offers.Listings.MerchantInfo', 'Offers.Summaries.LowestPrice', 'Offers.Listings.LoyaltyPoints.Points', 'Offers.Summaries.OfferCount', 'Offers.Listings.Condition', 'Offers.Listings.DeliveryInfo.IsFreeShippingEligible');

        # Forming the request
        $searchItemsRequest = new SearchItemsRequest();
        $searchItemsRequest->setSearchIndex($searchIndex);
        $searchItemsRequest->setCondition($condition);
        $searchItemsRequest->setSortBy($order_by);
        $searchItemsRequest->setKeywords($keyword);
        $searchItemsRequest->setItemCount($itemCount);
        $searchItemsRequest->setItemPage($pageCount);
        $searchItemsRequest->setPartnerTag($partnerTag);
        $searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
        $searchItemsRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $searchItemsRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            echo "Error forming the request", PHP_EOL;
            foreach ($invalidPropertyList as $invalidProperty) {
                echo $invalidProperty, PHP_EOL;
            }
            return;
        }

        # Sending the request
        try {

            $searchItemsResponse = $apiInstance->searchItems($searchItemsRequest);

            # Parsing the response
            if ($searchItemsResponse->getSearchResult() != null) {
                return $searchItemsResponse->getSearchResult();
            }
            if ($searchItemsResponse->getErrors() != null) {
                $data['TotalResultCount'] = 0;
                $data['products'] = $searchItemsResponse->getSearchResult();
                $data['error_positin'] = 'Printing first error object from list of errors';
                $data['error_code'] = $searchItemsResponse->getErrors()[0]->getCode();
                $data['error_message'] = $searchItemsResponse->getErrors()[0]->getMessage();
                $data['errors'] = array();
                $data['error_body'] = NULL;
                return $data;
                // echo json_encode($data);
            }
        } catch (ApiException $exception) {
            $data['TotalResultCount'] = 0;
            $data['products'] = NULL;
            $data['error_positin'] = 'Error calling PA-API 5.0!';
            $data['error_code'] = $exception->getCode();
            $data['error_message'] = $exception->getMessage();
            $data['errors'] = array();
            $data['error_body'] = NULL;



            // echo "Error calling PA-API 5.0!", PHP_EOL;
            // echo "HTTP Status Code: ", $exception->getCode(), PHP_EOL;
            // echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            if ($exception->getResponseObject() instanceof ProductAdvertisingAPIClientException) {
                // $errors = $exception->getResponseObject()->getErrors();
                $data['errors'] = $exception->getResponseObject()->getErrors();

            } else {
                // echo "Error response body: ", $exception->getResponseBody(), PHP_EOL;
                $data['error_body'] = $exception->getResponseBody();
            }
            return $data;
            // echo json_encode($data);
        } catch (Exception $exception) {
            // echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            $data['TotalResultCount'] = 0;
            $data['products'] = NULL;
            $data['error_positin'] = 'Error Exception calling PA-API 5.0!';
            $data['error_code'] = NULL;
            $data['error_message'] = $exception->getMessage();
            $data['errors'] = array();
            $data['error_body'] = NULL;
            return $data;
            // echo json_encode($data);
        }
    }

    function testsearchItems()
    {
        $config = new Configuration();

        /*
	     * Add your credentials
	     * Please add your access key here
	     */
        // Your Access Key ID, as taken from the Your Account page
        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";


        $config->setAccessKey($access_key_id);
        # Please add your secret key here
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";
        $config->setSecretKey($secret_key);

        # Please add your partner tag (store/tracking id) here
        $tracking_id = "nonmenber-22";
        $partnerTag = $tracking_id;

        /*
	     * PAAPI host and region to which you want to send request
	     * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
	     */
        $endpoint = "webservices.amazon.co.jp";
        $config->setHost($endpoint);
        $config->setRegion('us-west-2');

        $apiInstance = new DefaultApi(
        /*
	     * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
	     * This is optional, `GuzzleHttp\Client` will be used as default.
	     */
            new GuzzleHttp\Client(), $config);

        # Request initialization

        # Specify keywords
        $keyword = '4902102072625';

        # Choose item id(s)
        $itemIds = ["059035342X", "B00X4WHP55", "1401263119"];
        /*
	     * Specify the category in which search request is to be made
	     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/use-cases/organization-of-items-on-amazon/search-index.html
	     */
        $searchIndex = "All";

        # Specify item count to be returned in search result
        $itemCount = 10;

        /*
	     * Choose resources you want from SearchItemsResource enum
	     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/search-items.html#resources-parameter
	     */

        // const ITEM_INFOTITLE = 'ItemInfo.Title';
        // const OFFERSLISTINGSPRICE = 'Offers.Listings.Price';
        $resources = array('ItemInfo.Title', 'Offers.Listings.Price', 'BrowseNodeInfo.BrowseNodes', 'BrowseNodeInfo.BrowseNodes.SalesRank', 'BrowseNodeInfo.WebsiteSalesRank', 'BrowseNodeInfo.BrowseNodes.Ancestor', 'ItemInfo.ManufactureInfo', 'ItemInfo.ProductInfo', 'Images.Primary.Small', 'Images.Primary.Medium', 'Images.Primary.Large', 'Offers.Listings.MerchantInfo', 'Offers.Summaries.LowestPrice', 'Offers.Listings.LoyaltyPoints.Points', 'Offers.Summaries.OfferCount');

        # Forming the request
        $searchItemsRequest = new SearchItemsRequest();
        $searchItemsRequest->setSearchIndex($searchIndex);
        $searchItemsRequest->setCondition("New");
        $searchItemsRequest->setMinPrice(20);
        $searchItemsRequest->setSortBy("Price:LowToHigh");
        // $searchItemsRequest->setMerchant("All");
        $searchItemsRequest->setKeywords($keyword);
        $searchItemsRequest->setItemCount($itemCount);
        $searchItemsRequest->setPartnerTag($partnerTag);
        $searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
        $searchItemsRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $searchItemsRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            echo "Error forming the request", PHP_EOL;
            foreach ($invalidPropertyList as $invalidProperty) {
                echo $invalidProperty, PHP_EOL;
            }
            return;
        }

        # Sending the request
        try {
            $searchItemsResponse = $apiInstance->searchItems($searchItemsRequest);
            echo "<pre>";
            print_r(json_decode($searchItemsResponse->getSearchResult()));
            // echo $searchItemsResponse->getSearchResult()->getItems()[0];
            // echo "Ahsan Ullah";
            exit();
            echo 'API called successfully', PHP_EOL;
            echo 'Complete Response: ', $searchItemsResponse, PHP_EOL;

            # Parsing the response
            if ($searchItemsResponse->getSearchResult() != null) {
                echo 'Printing first item information in SearchResult:', PHP_EOL;
                $item = $searchItemsResponse->getSearchResult()->getItems()[0];
                if ($item != null) {

                    if ($item->getASIN() != null) {
                        echo "ASIN: ", $item->getASIN(), PHP_EOL;
                    }
                    if ($item->getDetailPageURL() != null) {
                        echo "DetailPageURL: ", $item->getDetailPageURL(), PHP_EOL;
                    }
                    if ($item->getItemInfo() != null
                        and $item->getItemInfo()->getTitle() != null
                        and $item->getItemInfo()->getTitle()->getDisplayValue() != null) {
                        echo "Title: ", $item->getItemInfo()->getTitle()->getDisplayValue(), PHP_EOL;
                    }
                    if ($item->getOffers() != null
                        and $item->getOffers() != null
                        and $item->getOffers()->getListings() != null
                        and $item->getOffers()->getListings()[0]->getPrice() != null
                        and $item->getOffers()->getListings()[0]->getPrice()->getDisplayAmount() != null) {
                        echo "Buying price: ", $item->getOffers()->getListings()[0]->getPrice()
                            ->getDisplayAmount(), PHP_EOL;
                    }
                }
            }
            if ($searchItemsResponse->getErrors() != null) {
                echo PHP_EOL, 'Printing Errors:', PHP_EOL, 'Printing first error object from list of errors', PHP_EOL;
                echo 'Error code: ', $searchItemsResponse->getErrors()[0]->getCode(), PHP_EOL;
                echo 'Error message: ', $searchItemsResponse->getErrors()[0]->getMessage(), PHP_EOL;
            }
        } catch (ApiException $exception) {
            echo "Error calling PA-API 5.0!", PHP_EOL;
            echo "HTTP Status Code: ", $exception->getCode(), PHP_EOL;
            echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            if ($exception->getResponseObject() instanceof ProductAdvertisingAPIClientException) {
                $errors = $exception->getResponseObject()->getErrors();
                foreach ($errors as $error) {
                    echo "Error Type: ", $error->getCode(), PHP_EOL;
                    echo "Error Message: ", $error->getMessage(), PHP_EOL;
                }
            } else {
                echo "Error response body: ", $exception->getResponseBody(), PHP_EOL;
            }
        } catch (Exception $exception) {
            echo "Error Message: ", $exception->getMessage(), PHP_EOL;
        }
    }


    function getBrowseNodes($browseNodeIds = array('71442051'), $partnerTag = "nonmenber-22")
    {
        $config = new Configuration();

        $access_key_id = "AKIAIG3EPZUI7TX5RTRA";


        $config->setAccessKey($access_key_id);
        # Please add your secret key here
        $secret_key = "8FmbqLwTtJiN9rTch2Gvclu/9Qbwz5ltaQ8bMWrJ";
        $config->setSecretKey($secret_key);

        # Please add your partner tag (store/tracking id) here


        /*
	     * PAAPI host and region to which you want to send request
	     * For more details refer: https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
	     */

        $endpoint = "webservices.amazon.co.jp";
        $config->setHost($endpoint);
        $config->setRegion('us-west-2');

        $apiInstance = new DefaultApi(
        /*
	     * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
	     * This is optional, `GuzzleHttp\Client` will be used as default.
	     */
            new GuzzleHttp\Client(), $config);

        # Request initialization

        # Specify browseNode id(s)


        /*
	     * Choose resources you want from GetItemsResource enum
	     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/getbrowsenodes.html#resources-parameter
	     */
        $resources = array(
            GetBrowseNodesResource::ANCESTOR,
            GetBrowseNodesResource::CHILDREN);

        # Forming the request
        $getBrowseNodesRequest = new GetBrowseNodesRequest();
        $getBrowseNodesRequest->setBrowseNodeIds($browseNodeIds);
        $getBrowseNodesRequest->setPartnerTag($partnerTag);
        $getBrowseNodesRequest->setPartnerType(PartnerType::ASSOCIATES);
        $getBrowseNodesRequest->setResources($resources);

        # Validating request
        $invalidPropertyList = $getBrowseNodesRequest->listInvalidProperties();
        $length = count($invalidPropertyList);
        if ($length > 0) {
            echo "Error forming the request", PHP_EOL;
            foreach ($invalidPropertyList as $invalidProperty) {
                echo $invalidProperty, PHP_EOL;
            }
            return;
        }

        # Sending the request
        try {
            $getBrowseNodesResponse = $apiInstance->getBrowseNodes($getBrowseNodesRequest);
            echo "API called successfully", PHP_EOL;
            echo "<pre>";
            print_r(json_decode($getBrowseNodesResponse));
            exit();
            # Parsing the response
            if ($getBrowseNodesResponse->getBrowseNodesResult() != null) {
                echo 'Printing all browse node information in BrowseNodesResult:', PHP_EOL;
                if ($getBrowseNodesResponse->getBrowseNodesResult()->getBrowseNodes() != null) {
                    $responseList = parseResponse($getBrowseNodesResponse->getBrowseNodesResult()->getBrowseNodes());
                    foreach ($browseNodeIds as $browseNodeId) {
                        echo "Printing information about the browse node with Id: ", $browseNodeId, PHP_EOL;
                        if ($responseList[$browseNodeId] != null) {
                            $browseNode = $responseList[$browseNodeId];
                            if ($browseNode->getId() != null) {
                                echo 'BrowseNode Id: ', $browseNode->getId(), PHP_EOL;
                            }
                            if ($browseNode->getDisplayName() != null) {
                                echo 'DisplayName: ', $browseNode->getDisplayName(), PHP_EOL;
                            }
                            if ($browseNode->getContextFreeName() != null) {
                                echo 'ContextFreeName: ', $browseNode->getContextFreeName(), PHP_EOL;
                            }
                        } else {
                            echo "BrowseNode not found, check errors", PHP_EOL;
                        }
                    }
                }
            }
            if ($getBrowseNodesResponse->getErrors() != null) {
                echo PHP_EOL, 'Printing Errors:', PHP_EOL, 'Printing first error object from list of errors', PHP_EOL;
                echo 'Error code: ', $getBrowseNodesResponse->getErrors()[0]->getCode(), PHP_EOL;
                echo 'Error message: ', $getBrowseNodesResponse->getErrors()[0]->getMessage(), PHP_EOL;
            }
        } catch (ApiException $exception) {
            echo "Error calling PA-API 5.0!", PHP_EOL;
            echo "HTTP Status Code: ", $exception->getCode(), PHP_EOL;
            echo "Error Message: ", $exception->getMessage(), PHP_EOL;
            echo "Request ID: ", $exception->getResponseHeaders()['x-amzn-RequestId'][0], PHP_EOL;
            if ($exception->getResponseObject() instanceof ProductAdvertisingAPIClientException) {
                $errors = $exception->getResponseObject()->getErrors();
                foreach ($errors as $error) {
                    echo "Error Type: ", $error->getCode(), PHP_EOL;
                    echo "Error Message: ", $error->getMessage(), PHP_EOL;
                }
            } else {
                echo "Error response body: ", $exception->getResponseBody(), PHP_EOL;
            }
        } catch (Exception $exception) {
            echo "Error Message: ", $exception->getMessage(), PHP_EOL;
        }
    }

    public function get_amazon_appstore_tocken()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.amazon.com/auth/o2/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "grant_type=client_credentials&client_id=amzn1.application-oa2-client.c5cee82ee2fd477bb42645fb633a9c6e&client_secret=0ddc9a09c9b8df3a6f506bfddb1f951f35696cf4389a5d47a005f04e10b752d6&scope=adx_reporting::appstore:marketer");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        // print_r($server_output);
        // exit();
        return $server_output;
        // further processing ....
        // if ($server_output == "OK") { ... } else { ... }
    }

    public function get_amazon_slase_report()
    {

        $tocken = json_decode($this->get_amazon_appstore_tocken());
        // $amazon_token_session = $this->session->set_userdata('tocken_id', $tocken->access_token)
        // echo "<pre>"; print_r($tocken);
        // echo $tocken->access_token;
        $access_token = $tocken->access_token;
        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, 'https://developer.amazon.com/api/appstore/download/report/sales/2020/07');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token
        ));
        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        print_r($response);
        // $jsonArrayResponse - json_decode($phoneList);


    }

    // Users point History
    public function get_user_point_history($user_id)
    {
        //$data['user_info'] = $this->account_model->get_by_id($user_id);
        $data = array();
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        if ($this->authentication->is_signed_in()) {
//          $user_id = $this->session->userdata('account_id');
            $data['user_info'] = $this->account_model->get_by_id($user_id);
//			print_r($data['user_info']);
//			exit();
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            //$data['company_details'] = $this->points_model->get_company_details();
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit();
        $this->load->view('jacos_point_details/customer_point_history', $data);

    }

    public function get_company_user_history($user_id)
    {
        //$data['user_info'] = $this->account_model->get_by_id($user_id);
        $data = array();
        $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        if ($this->authentication->is_signed_in()) {
//          $user_id = $this->session->userdata('account_id');
            $data['user_info'] = $this->account_model->get_by_id($user_id);
            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->points_model->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            //$data['company_details'] = $this->points_model->get_company_details();

            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit();
        $this->load->view('jacos_point_details/company_customer_history', $data);

    }

    // Companys point History
    public function get_company_point_history()
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'allcompany_member_list'));
        }

        // Redirect unauthorized users to account profile page
        if (!$this->authorization->is_permitted('company_margin')) {
            redirect(base_url());
        }

        // Redirect unauthenticated users to signin page
        if ($this->authentication->is_signed_in()) {
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        }

        $this->load->view('jacos_point_details/companylist_point_history', $data);

    }


    public function getall_company_history($period = NULL, $end_date = NULL)
    {
        $company_list = $this->points_model->company_list();
        // print_r($company_list);
        // exit();
        $data = array();
        $company_summary = array();
        // $data['unknown_per'] = $this->points_model->get_summary_by_unknown('perm', $period, $end_date);
        // $data['unknown_temp'] = $this->points_model->get_summary_by_unknown('temp', $period, $end_date);
        foreach ($company_list as $key => $company) {
            $company_temp_total = $this->points_model->get_temp_summary_by_com_id($company->user_id, "all", $end_date);

            $company_per_total = $this->points_model->get_per_summary_by_com_id($company->user_id, "all", $end_date);

            $company_exchange_total = $this->points_model->get_total_excange_by_com_id($company->user_id, "all", $end_date);

            $last_trans_date = $end_date;
            $temp_order_amount = $company_temp_total->order_amount == NULL ? 0 : $company_temp_total->order_amount;
            $temp_point_amount = $company_temp_total->point_amount == NULL ? 0 : $company_temp_total->point_amount;

            $per_order_amount = $company_per_total->order_amount == NULL ? 0 : $company_per_total->order_amount;
            $per_point_amount = $company_per_total->point_amount == NULL ? 0 : $company_per_total->point_amount;
            $sum_data['user_id'] = $company->user_id;
            $sum_data['major_company'] = $company->major_company_jacos;
            $sum_data['role_name'] = $company->role_name;
            $sum_data['company_name'] = $company->company_name;
            $sum_data['member_mar'] = $company->member_mar;
            $sum_data['com_mar'] = $company->com_mar;
            // Temporary Points
            $sum_data['last_trans_date'] = $last_trans_date;
            $sum_data['temp_order_amount'] = $temp_order_amount;
            $sum_data['temp_point_amount'] = $temp_point_amount;
            $sum_data['temp_company_point'] = $company_temp_total->company_point == NULL ? 0 : $company_temp_total->company_point;
            $sum_data['temp_user_point'] = $company_temp_total->user_point == NULL ? 0 : $company_temp_total->user_point;
            $sum_data['temp_jafa_point'] = $company_temp_total->jafa_point == NULL ? 0 : $company_temp_total->jafa_point;
            // Permanent Point
            $sum_data['per_order_amount'] = $per_order_amount;
            $sum_data['per_point_amount'] = $per_point_amount;
            $sum_data['per_company_point'] = $company_per_total->company_point == NULL ? 0 : $company_per_total->company_point;
            $sum_data['per_user_point'] = $company_per_total->user_point == NULL ? 0 : $company_per_total->user_point;
            $sum_data['per_jafa_point'] = $company_per_total->jafa_point == NULL ? 0 : $company_per_total->jafa_point;

            // Excenge report
            $sum_data['user_point_exchange'] = $company_exchange_total->amount == NULL ? 0 : $company_exchange_total->amount;

            $company_summary[] = $sum_data;
        }
        $data['company_summary'] = $company_summary;
        echo json_encode($data);
    }


    public function get_admin_all_users_history()
    {
        //$data['user_info'] = $this->account_model->get_by_id($user_id);
        $data = array();
        //$data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));
        if ($this->authentication->is_signed_in()) {

            $data['user_info'] = $this->account_model->get_by_id();

            $user_type = 'member';
            if ($data['user_info']->role_id == 1) {
                $user_type = 'admin';
            } elseif ($data['user_info']->role_id == 2) {
                $user_type = 'company';
            } else {
                $user_type = "member";
            }
//           echo $user_id;exit;
            $data['user_temp_points'] = $this->PointsDetailsModel->get_company_summary_detail_by_com_id($user_id, 'temp', 'all', NULL, $user_type);
            $data['user_perm_points'] = $this->PointsDetailsModel->get_company_summary_detail_by_com_id($user_id, 'perm', 'all', NULL, $user_type);
            $data['temporary_point'] = 0;
            $data['permanent_point'] = 0;
            $data['converted_point'] = $this->points_model->get_converted_point_total($data['user_info']->id);
            //$data['company_details'] = $this->points_model->get_company_details();
            $data['success'] = 1;

        } else {
            $data['success'] = 0;
            $data['data'] = "ポイント確認するにはログインしてください。";
        }
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit();

        $this->load->view('jacos_point_details/company_customer_history', $data);

    }
}