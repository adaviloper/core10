import Head from 'next/head';
import { useAuth } from '@/hooks/auth';
import { useInfoBroker } from '@/hooks/info-broker';
import QuestionCard from '@/components/QuestionCard/QuestionCard';
import React, {
    useEffect,
    useState,
} from 'react';
import ShipDetails from '@/components/Ship/ShipDetails/ShipDetails';
import List from '@/components/UI/List';

export default function Home() {
    const { getApiData } = useInfoBroker();
    const [errors, setErrors] = useState({});
    const [apiData, setApiData] = useState([]);
    const [question, setQuestion] = useState('');
    const [component, setComponent] = useState(null);


    useEffect(() => {
        if (question === 'starships') {
            setComponent(apiData.map(ship => (
                <ShipDetails ship={ship} />
            )));
        }
        if (question === 'species') {
            setComponent(<List data={apiData} />);
        }
        if (question === 'population') {
            setComponent(
                <div className="min-h-full grid grid-cols-1 gap-4 content-center text-center text-white">
                    <div className="grow">
                        The population of the galaxy is estimated to be {apiData.toLocaleString()}.
                    </div>
                </div>
            )
        }
    }, [apiData])

    function getShipsHandler() {
        setQuestion('starships')
        getApiData({
            setErrors,
            setDataHandler: setApiData,
            url: 'api/sw/people/1/starships',
        });
    }

    function getEpisodeSpeciesHandler() {
        setQuestion('species')
        getApiData({
            setErrors,
            setDataHandler: setApiData,
            url: 'api/sw/films/4/species',
        });
    }

    function getPopulationHandler() {
        setQuestion('population')
        getApiData({
            setErrors,
            setDataHandler: setApiData,
            url: 'api/sw/planets/population',
        });
    }

    return (
        <>
            <Head>
                <title>Core10</title>
            </Head>

            <div className="relative px-4 items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <div className="max-w-full mx-auto sm:px-6 lg:px-8 p-5">
                    <h2 className="h1 text-4xl text-white text-center">What would you like to know?</h2>
                </div>
                <div className="flex flex-row rounded-lg overflow-hidden">
                    <div className="flex w-1/4">
                        <div className="flex flex-col space-y-2">

                            <QuestionCard
                                onClickEvent={getShipsHandler}
                                headerCopy="Which ships has Luke Skywalker piloted?"
                            />

                            <QuestionCard
                                onClickEvent={getEpisodeSpeciesHandler}
                                headerCopy="Which species made an appearance in Episode 1?"
                            >

                            </QuestionCard>

                            <QuestionCard
                                onClickEvent={getPopulationHandler}
                                headerCopy="How many people exist in the galaxy?"
                            >
                            </QuestionCard>

                        </div>
                    </div>
                    <div className="bg-gray-800 grow border-l border-blue-900 justify-content-center">
                        {component}
                    </div>
                </div>
            </div>
        </>
    )
}
