import "./App.css";

import Content from "./components/Content/Content";
import Filtres from "./components/Filtres/Filtres";
import Header from "./components/Header/Header";
import ProductProvider from "./components/ProductContext/context";
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';

library.add(fas);

function App() {
  return (
    <ProductProvider>
      <div id="header">
        <Header></Header>
      </div>
      <Content></Content>
      <Filtres></Filtres>
    </ProductProvider>
  );
}

export default App;
