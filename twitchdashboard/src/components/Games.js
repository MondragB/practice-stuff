import React, {useState, useEffect} from 'react';
import api from '../../src/api';
import {Link} from 'react-router-dom';

function Games(){

    const [games, setGames] = useState([])

    useEffect( () => {
        const fetchData = async () => {
            const result = await api.get('https://api.twitch.tv/helix/games/top');
			let dataArray = result.data.data;
			let finalArray = dataArray.map(game => {
                let newURL = game.box_art_url.replace('{width}', '300').replace('{height}', '300');
				game.box_art_url = newURL;
			    return game;
			});
            setGames(finalArray);
        };
        fetchData();
    }, [])

    return (
        <div>
            <h1 className='text-center'>Most Popular Games</h1>
            <div className="row">
                {games.map(game => (
                    <div className="col-lg-3 col-md-6 col-sm-12 mt-5">
                        <div className="card">
                            <img className="card-img-top" src={game.box_art_url} alt="So and So"/>
                            <div className="card-body">
                                <h5 className="text-center card-title">{game.name}</h5>
                                <div className='text-center'>
                                    <button className="btn btn-success">
                                        <Link
                                        className="link"
                                        to={{
                                            pathname: "game/" + game.name,
                                            state: {
                                                gameID: game.id
                                            }
                                        }}
                                        >
                                        {game.name} streams {" "}
                                        </Link>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    )
}

export default Games;