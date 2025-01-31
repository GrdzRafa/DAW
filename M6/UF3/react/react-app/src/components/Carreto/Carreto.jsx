import { useContext } from "react";
import  {ProductContext} from "../ProductContext/context";
function Carreto() {
    const {carreto, setCarreto} = useContext(ProductContext);
  return (
    <div>
      {carreto.length}
    </div>
  )
}

export default Carreto
