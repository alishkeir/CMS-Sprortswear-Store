import axios from "axios";
import React, { useEffect, useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import {  Card, CardDeck } from "react-bootstrap";
const AllItems=()=> {
  const url = `http://localhost:8000/api/items`;
  const [items, setItems] = useState([]);

  useEffect(() => {
    axios.get(url).then((res) => {

      setItems(res.data.data);
    });
  }, [url]);

  const showItems = items.map((item) => {
    return (
 
      <Card
        className="mt-4"
        style={{
          width: "18rem",
          minWidth: "18rem",
          maxWidth: "18rem",
          maxHeight: "20rem",
          textOverflow: "ellipsis",
          whiteSpace: "wrap",
          overflow: "hidden",
        }}
        key={item.id}
      >
        <Card.Img
          variant="top"
          src={`http://localhost:8000/storage/${item.image}`}
          alt="profile "
        />
        <Card.Body>
          <Card.Title>{item.name}</Card.Title>
          <Card.Text
            style={{
              maxWidth: "13rem",
              maxHeight: "5rem",
              textOverflow: "ellipsis",
              whiteSpace: "pre",
              overflow: "hidden",
            }}
          >
            {item.description}
          </Card.Text>
          <Card.Text>{item.price} $</Card.Text>
        </Card.Body>
      </Card>
    );
  });

  return (
    <div>
      <CardDeck style={{ maxWidth: "80em" }} className="m-auto">
        {showItems}
      </CardDeck>
    </div>
  );
}
export default AllItems;