import React, {useState, useEffect} from 'react';
import api from '../../src/api';

function Streams({match, location}){

    const [channels, setChannels] = useState([]);

    useEffect ( () => {
        const fetchData =  async () => {
            const results = await api.get(`https://api.twitch.tv/helix/streams`);
            let dataArray = results.data.data;
            let gameIDs = dataArray.map(stream => {
                return stream.game_id
            });
            let baseURL = `https://api.twitch.tv/helix/games?`;
            let queryParams = '';
            gameIDs.map(id => {
                return (queryParams += `id=${id}&`)
            });
            let finalURL = baseURL + queryParams;
            let gameNames = await api.get(finalURL);
            let gamesNameArray = gameNames.data.data;

			let finalArray = dataArray.map(stream => {
                stream.gameName = '';
                gamesNameArray.map(name => {
                    if(stream.game_id === name.id)
                        return stream.gameName = name.name;
                });
                let newURL = stream.thumbnail_url.replace('{width}', '300').replace('{height}', '300');
			    stream.thumbnail_url = newURL;
			    return stream;
            });
            setChannels(finalArray);
        }
        fetchData();
    }, []);
    return (
        <div>
            <h1 className='text-center'>Most Popular Streams</h1>
            <div className='row'>
                {channels.map(channel => (
                    <div className='col-lg-3 col-md-6 col-sm-12 mt-5'>
                        <div className='card'>
                            <img className='card-img-top' src={channel.thumbnail_url} alt='stream thumbail'/>
                            <div className='card-body'>
                                <h5 className='text-center card-title'>{channel.user_name}</h5>
                                <h4 className='text-center card-title'>{channel.gameName}</h4>
                                <div className='text-center card-text'>
                                    {channel.viewer_count} live viewers
                                </div>
                                <div className='text-center'>
                                    <button className='btn btn-success'>
                                        <a
                                            className='link'
                                            href={"https://twitch.tv/" + channel.user_name}
                                            target = "_blank"
                                            rel='noopener noreferrer'
                                        >
                                        watch {channel.user_name}'s channel    
                                        </a>
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

export default Streams;