import React from 'react';
import List from '@/components/UI/List';

const ShipDetails = ({ ship }) => {

    const primitiveDetailsLeft = [
        {
            label: 'Model',
            value: ship.model,
        },
        {
            label: 'Starship Class',
            value: ship.starship_class,
        },
        {
            label: 'Manufacturer',
            value: ship.manufacturer,
        },
        {
            label: 'Hyperdrive Rating',
            value: ship.hyperdrive_rating,
        },
        {
            label: 'Cost in Credits',
            value: ship.cost_in_credits,
        },
        {
            label: 'Length',
            value: ship.length,
        },
        {
            label: 'Pilots',
            value: ship.pilots,
        },
    ]

    const primitiveDetailsRight = [
        {
            label: 'Passengers',
            value: ship.passengers,
        },
        {
            label: 'Cargo Capacity',
            value: ship.cargo_capacity,
        },
        {
            label: 'Max Atmosphering Speed',
            value: ship.max_atmosphering_speed,
        },
        {
            label: 'Crew',
            value: ship.crew,
        },
        {
            label: 'MGLT',
            value: ship.MGLT,
        },
        {
            label: 'URL',
            value: ship.url,
        },
        {
            label: 'Films',
            value: ship.films,
        },
    ];

    return (
        <div className="text-white bg-gray-700 mb-2 rounded py-2 px-4">
            <div className="text-4xl">
                {ship.name}
            </div>
            <hr />

            <div className="columns-2">
                <List data={primitiveDetailsLeft} />
                <List data={primitiveDetailsRight} />
            </div>

        </div>
    );
}

export default ShipDetails;
