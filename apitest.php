public function add_catalog_product() {
         $postdata = json_decode(file_get_contents("php://input"), true);
         $store_id=$postdata['store_id'];
         $user_id=$postdata['user_id'];
         $category_id=$postdata['category_id'];
         $sub=$postdata['sub_category_id'];
          $category_name = $this->db->query("select * from category where id='" . $category_id . "'")->row_array();
          $ecommerce_category=array('user_id'=> $this->user_id,
                'store_id '=> $store_id,
                'thumbnail'=> $category_name['thumbnail'],
                'category_name'=> $category_name['name'],
                'status'=> '1',
                'updated_at'=> date("Y-m-d H:i:s"));
            if ($this->db->insert('ecommerce_category',$ecommerce_category)){
                $cat_id = $this->db->insert_id();
            }
        foreach($sub as $subdata){
        $sub_id=$subdata['id'];
          $sub_category_name = $this->db->query("select * from sub_category where id='" . $sub_id . "'")->row_array();
        }


            $category_name = $this->db->query("select * from category where id='" . $category_id . "'")->row_array();

            $ecommerce_category=array('user_id'=> $this->user_id,
                'store_id '=> $store_id,
                'thumbnail'=> $category_name['thumbnail'],
                'category_name'=> $category_name['name'],
                'status'=> '1',
                'updated_at'=> date("Y-m-d H:i:s"));
            if ($this->db->insert('ecommerce_category',$ecommerce_category)){
                $cat_id = $this->db->insert_id();
            }
            $ecommerce_sub_category=array('user_id'=> $this->user_id,
                'store_id '=> $store_id,
                'category_id'=>$cat_id,
                'thumbnail'=> $sub_category_name['thumbnail'],
                'sub_category_name'=> $sub_category_name['name'],
                'status'=> '1',
                'updated_at'=> date("Y-m-d H:i:s"));

            if ($this->db->insert('ecommerce_sub_category',$ecommerce_sub_category)){
                $subcat_id = $this->db->insert_id();
            }

            $status = $this->input->post("status", true);
            if (!isset($status) || $status == '')
                $status = '0';
            $inserted_data = array();
            for ($x = 0; $x < $is_checked; $x++) {
                $inserted_data[] = array(
                    'user_id' => $this->user_id,
                    'store_id' => $store_id,
                    'product_name' => $product_name[$x],
                    'thumbnail'=>$product_thumbnail[$x],
                    'category_id' => $cat_id,
                    'sub_category_id' => $subcat_id,
                    'original_price' => $price[$x],
                    'stock_item' => $qty[$x],
                    'status' => '1',
                    'deleted' => '0',
                    'updated_at' => date("Y-m-d H:i:s")
                );
            }
            if ($this->db->insert_batch('ecommerce_product', $inserted_data)) {
                $result['status'] = "1";
                $result['message'] = $this->lang->line("Product has been added successfully.");
            }
            echo json_encode($result);
        }
    }
