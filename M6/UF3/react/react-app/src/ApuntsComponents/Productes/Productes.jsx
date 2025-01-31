import { useEffect, useState } from 'react'

export default function Productes() {
    const [productes, setProductes] = useState([]);
    // const [loading, setLoading] = useState(true);
    // const [error, setError] = useState(null);
    const comencar = true;
    useEffect(() => {
        
        if (comencar) {
            fetch('https://jsonplaceholder.typicode.com/users')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error a l'API: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                setProductes(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

    }, [comencar]);

  return (
    <div>
        <ul>
            {productes.map((producte) => (
                <li key={producte.id}>Name: {producte.name}</li>
            ))}
        </ul>
    </div>
  )
}
