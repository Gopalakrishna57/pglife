import React, { useState } from 'react';

function App() {
  const [properties] = useState([
    {
      id: 1,
      name: "Ganpati Homes",
      address: "Viman Nagar, Pune",
      gender: "boys",
      rent: "Rs 8,500/-",
      rating: "4.8",
      image: "https://images.unsplash.com/photo-1555854877-bab0e564b8d5?q=80&w=500"
    },
    {
      id: 2,
      name: "Navkar Boarding House",
      address: "Kothrud, Pune",
      gender: "unisex",
      rent: "Rs 9,500/-",
      rating: "4.5",
      image: "https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?q=80&w=500"
    },
    {
      id: 3,
      name: "Saraswati Paying Guest",
      address: "Hinjawadi, Pune",
      gender: "girls",
      rent: "Rs 7,000/-",
      rating: "4.2",
      image: "https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?q=80&w=500"
    }
  ]);

  return (
    <div className="container my-5">
      <h2 className="mb-4 text-center text-primary">⚡ Available Properties (React View)</h2>
      <p className="text-muted text-center mb-5">Internshala Project Guideline: Converted Property Feature into React Component</p>
      
      <div className="row">
        {properties.map(property => (
          <div className="col-md-4 mb-4" key={property.id}>
            <div className="card h-100 shadow-sm">
              <img src={property.image} className="card-img-top" alt={property.name} style={{height: "200px", objectFit: "cover"}} />
              <div className="card-body">
                <div className="d-flex justify-content-between align-items-center mb-2">
                  <span className={`badge ${property.gender === 'boys' ? 'bg-primary' : property.gender === 'girls' ? 'bg-danger' : 'bg-success'}`}>
                    {property.gender.toUpperCase()}
                  </span>
                  <span className="text-warning">⭐ {property.rating}</span>
                </div>
                <h5 className="card-title fw-bold">{property.name}</h5>
                <p className="card-text text-muted mb-2">{property.address}</p>
                <h6 className="text-primary fw-bold mb-3">{property.rent} / month</h6>
                <button className="btn btn-outline-primary w-100">View Details</button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default App;
