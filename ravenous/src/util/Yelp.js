const apiKey = '5URVW4Kk2Hsp8Jrxt8gRWlL3FYzpsaI9RNPnj2sxOZnGh-IXQ11gP8clyiePzl4TojgUhT2bUKp_xWPqh54Ao3SDfY89-j4C5_qAC_EPnV64_G97q2ABIbOUrZVuXXYx';

 const Yelp = {
	search(term, location, sortBy) {
		return fetch(`https://cors-anywhere.herokuapp.com/https://api.yelp.com/v3/businesses/search?term=${term}&location=${location}&sort_by=${sortBy}`, {
			headers: {
				Authorization: `Bearer ${apiKey}`
			}
		}).then(response => { 
			return response.json(); 
		}).then(jsonResponse => {
			if (jsonResponse.businesses) {
				return jsonResponse.businesses.map(business => ({
					id: business.id,
					imageSrc: business.image_url,
					name: business.name,
					address: business.location.address1,
					city: business.location.city,
					state: business.location.state,
					zipCode: business.location.zipCode,
					category: business.categories[0].title,
					rating: business.rating,
					reviewCount: business.review_count
				}));
			}
		});
	}
};

export default Yelp;