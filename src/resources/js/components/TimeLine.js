import React, {useState} from 'react';
import {Col, Row, ToggleButton, ToggleButtonGroup} from "react-bootstrap";
import Tweet from './Tweet';

const FAVORITE_ERROR_CODES = {
  ALREADY_FAVORITED: 1,
  FAVORITE_IS_NOT_EXISTS: 2,
};


export default function TimeLine(props) {
  const [selectedTweetsMode, setSelectedTweetsMode] = useState('all');
  const handleFollow = (tweet) => {
    const params = {
      followUserId: tweet.user_id,
    }
    axios.post('follows', params)
      .then(res => {
        props.doFollow(tweet, res.data.follow);
      })
      .catch();
  };
  const handleRemoveFollow = (tweet) => {
    const params = {
      followId: tweet.follow_id,
    };
    axios.delete('follows/' + tweet.follow_id, {
      data: params
    })
      .then(() => {
        props.removeFollow(tweet);
      })
      .catch();
  };
  const handleFavorite = (tweet) => {
    const params = {
      tweetId: tweet.id,
      userId: _loginUser.id,
    }
    axios.post('favorites', params)
      .then(res => {
        props.doFavorite(tweet, res.data.favorite);
      })
      .catch(error => {
        const errorData = error.response.data;
        if(errorData.code === FAVORITE_ERROR_CODES.ALREADY_FAVORITED) {
          console.error(errorData.message);
          props.doFavorite(tweet, errorData.favorite);
          return;
        }
        console.error(error);
      });
  };

  const handleRemoveFavorite = (tweet) => {
    axios.delete('favorites/' + tweet.favorite_id)
      .then(() => {
        props.removeFavorite(tweet);
      })
      .catch(error => {
        console.log(error.response.data);
      });
  };

  const handleRemoveTweet = (tweet) => {
    axios.delete('tweets/' + tweet.id)
      .then(res => {
        props.removeTweet(tweet);
      }).catch(error => {
        console.error(error);
      })
  };

  const handleTweetsModeChange = (type) => {
    props.updateTiimeLine(type);
  };

  return(
    <>
      <Row style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', backgroundColor: 'rgba(0, 0, 0, 0.03)' }}>
        <Col>
          <ToggleButtonGroup type="radio" name="mode_options" defaultValue={selectedTweetsMode} onChange={handleTweetsModeChange}>
            <ToggleButton value={'all'}>すべてのツイート</ToggleButton>
            <ToggleButton value={'follow'}>フォローしているツイート</ToggleButton>
            <ToggleButton value={'favorite'}>お気に入りしているツイート</ToggleButton>
          </ToggleButtonGroup>
        </Col>
      </Row>
      {props.tweets.map(t =>
        <Tweet
          key={t.id}
          tweet={t}
          handleFollow={handleFollow}
          handleRemoveFollow={handleRemoveFollow}
          handleFavorite={handleFavorite}
          handleRemoveFavorite={handleRemoveFavorite}
          handleRemoveTweet={handleRemoveTweet}
        />
      )}
    </>
  );

}

