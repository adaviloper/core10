import React from 'react';

const List = ({ data }) => {
    if (data.length === 0) {
        return null;
    }

    function getListItemLabel(element) {
        if (element.label) {
            return `${element.label}: `;
        }

        return null;
    }
    function getListItemValue(element) {
        if (Array.isArray(element)) {
            return <List data={element} />;
        }

        if (element.value && Array.isArray(element.value)) {
            return <List data={element.value} />;
        }

        if (element.label) {
            return `${element.value}`;
        }

        return element;
    }

    function randomKey() {
        return Math.random().toString(36).substring(2, 8);
    }

    return (
        <div className="max-w-5xl m-auto">
            <ul className="border border-gray-700 rounded w-full overflow-hidden shadow-md">
                {data.map((datum, index) => (
                    <li
                        key={`list-item-${index}-${randomKey()}`}
                        className="text-white px-4 py-2 bg-gray-700 hover:bg-sky-100 hover:text-sky-900 border-b last:border-none border-gray-600 transition-all duration-300 ease-in-out"
                    >
                        <b>{getListItemLabel(datum)}</b>{getListItemValue(datum)}
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default List;
