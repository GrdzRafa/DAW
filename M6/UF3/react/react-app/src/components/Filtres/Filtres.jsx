import { useEffect, useState } from "react";

export default function Filtres() {
  const [filtres, setFiltres] = useState([]);

  useEffect(() => {
    fetch("http://localhost:5173/src/media/p3filtres.php", {
            method: "POST",
            body: JSON.stringify(filtres)
        })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Error a l'API: ${response.statusText}`);
        }
        return response.json();
      })
      .then((data) => {
        setFiltres(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }, [filtres]);

  console.log(filtres);
}
