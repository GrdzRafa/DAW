import "./App.css";
import Carreto from "./components/Carreto/Carreto";
import Content from "./components/Content/Content";
import ProductProvider from "./components/ProductContext/context";

function App() {
  return (
    <ProductProvider>
        <Carreto></Carreto>
      <Content></Content>
    </ProductProvider>
  );
}

export default App;
