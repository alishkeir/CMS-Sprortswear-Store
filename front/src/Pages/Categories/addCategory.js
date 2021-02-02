import React, { useState } from "react";
import { Form, Button } from "react-bootstrap";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";

const AddCategory = () => {
  const url = `http://localhost:8000/api/categories`;
  const [name, setName] = useState("");
  const [image, setImage] = useState(null);
  const [categories, setCategories] = useState([]);

  const onChangeName = (e) => {
    console.log(e.target.value);
    setName(e.target.value);
  };

  const onChangeImage = (e) => {
    console.log(e.target.files[0]);
    // console.log(e);
    setImage(e.target.files[0]);
  };

  onsubmit = (e) => {
    e.preventDefault();

    const category = new FormData();
    category.append("name", name);
    category.append("image", image);

    axios.post(url, category).then((res) => {
      setCategories(res.data);
      alert("Category Added");
      setImage(null);
      setName("");
    });
  };

  return (
    <>
      <Form className="w-50 mx-auto mt-5">
        <Form.Group>
          <Form.Label>Category Name</Form.Label>
          <Form.Control
            type="text"
            onChange={(e) => {
              onChangeName(e);
            }}
          />
        </Form.Group>
        <Form.Group>
          <Form.File
            label="Category Image"
            onChange={(e) => {
              onChangeImage(e);
            }}
          />
        </Form.Group>
        <Button variant="primary" type="submit">
          Submit
        </Button>
      </Form>
      <div className="alert alert-success w-50 m-auto"> Hello</div>
    </>
  );
};
export default AddCategory;
