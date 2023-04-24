import React, {
    useEffect,
    useState,
} from 'react';
import './QuestionCard.module.css'
import { useInfoBroker } from '@/hooks/info-broker';
import ShipDetails from '@/components/Ship/ShipDetails/ShipDetails';

const QuestionCard = ({ onClickEvent, headerCopy, children }) => {
    return (
        <button
            onClick={onClickEvent}
            className="bg-gray-800 p-6">
            <div className="flex items-center">
                <div className="ml-4 text-white text-lg leading-7 font-semibold">
                    <p>
                        {headerCopy}
                    </p>
                </div>
            </div>

            <div className="ml-12">
                {children}
            </div>

        </button>
    );
};

export default QuestionCard;
