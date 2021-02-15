// import AllItems from "./Pages/Items/allItems";
import { useState, useMemo, useEffect } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import {
  BrowserRouter as Router,
  Redirect,
  Route,
  Switch,
} from "react-router-dom";
import UserContext from "./Components/UserContext";

import Protected from "./Components/Protected";
import AddCategory from "./Pages/Categories/addCategory";
import LoginPage from "./Pages/LoginPage";
import cookie from "js-cookie";
import axios from "axios";
import jwt from "jsonwebtoken";
import NavBar from "./Components/NavBar";
import styled from "styled-components";
import Home from "./Pages/home"


const Main = styled.main`
  width: 80%;
  margin: 5rem auto 0;
  padding-left: 4rem;
`;


const App = () => {
  const [token, setToken] = useState(null);
  const providerValue = useMemo(() => ({ token, setToken }), [token, setToken]);
  axios.defaults.headers.common["Authorization"] = "bearer " + token;
  const jwtSecret =
    "JkCl1V9I3EOyepENhNegKc2UxghSbnvnWVeujph5BJpEtbSDwX6ECpfUHH82Cbnv";

  useEffect(() => {
    if (cookie.get("token")) {
      setToken(cookie.get("token"));
    }
  }, []);

  if (token) {
    jwt.verify(token, jwtSecret, (err, decoded) => {
      if (err) {
        cookie.remove("token");
        setToken(null);
      } else {
        if (decoded.iss !== "http://localhost:8000/api/auth/login") {
          cookie.remove("token");
          setToken(null);
        }
      }
    });
  }

  return (
    <>
      <UserContext.Provider value={providerValue}>
        <Router>
          <Switch>
            <Route
              exact={true}
              path="/login"
              component={(props) => <LoginPage isAuth={token} />}
            />

            <Main>

            <Protected
                isAuth={token}
                exact={true}
                path="/"
                component={(props) => <Home />}
              />

              <NavBar />
            </Main>

            <Redirect from="/*" to="/" />
          </Switch>
        </Router>
      </UserContext.Provider>
    </>
  );
};

export default App;
