<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{
	function Products(){
		parent::Controller();
	}

    public function index(){
		$products = array("products" => new Product());
		$this->load->view("index", $products);
    }

	public function create(){
		$product = new Product();

		$product->name = $this->input->post("name");
		$product->description = $this->input->post("description");
		$product->price = $this->input->post("price");
		$product->created_at = date("Y-m-d, H:i:s");
		$product->updated_at = date("Y-m-d, H:i:s");

		if($product->save()){
			redirect("/");
		}
		else{
			$errors = array(
				"error_name" => $product->error->name,
				"error_description" => $product->error->description,
				"error_price" => $product->error->price
			);

			$this->session->set_userdata('name', $this->input->post("name"));
			$this->session->set_userdata('description', $this->input->post("description"));
			$this->session->set_userdata('price', $this->input->post("price"));

			$this->session->set_userdata($errors);
			redirect("/");
		}
	}

	public function show($id){
		$product = new Product();
		$get_data = array("get_data" => $product->get_by_id($id));
		$this->load->view("show", $get_data);
	}

	public function edit($id){
		$product = new Product();
		$get_data = array("get_data" => $product->get_by_id($id));
		$this->load->view("edit", $get_data);
	}

	public function update($id){
		$product = new Product();
		
		$products = $product->get_by_id($id);

		foreach($products AS $product){
			$product->name = $this->input->post("name");
			$product->description = $this->input->post("description");
			$product->price = $this->input->post("price");
			$product->updated_at = date("Y-m-d, H:i:s");

			if($product->save()){
				$this->session->set_userdata("message", "Product updated successfully!");
				$this->edit($id);
			}
			else{
				$errors = array(
					"error_name" => $product->error->name,
					"error_description" => $product->error->description,
					"error_price" => $product->error->price
				);
	
				$this->session->set_userdata($errors);
				$this->edit($id);
			}
		}
	}

	public function remove($id){
		$product = new Product();
		$get_data = array("get_data" => $product->get_by_id($id));
		$this->load->view("remove", $get_data);
	}

    public function delete($id){
		$product = new Product();
		$product->where("id", $id)->get();
		$product->delete();
		redirect("/");
    }
}