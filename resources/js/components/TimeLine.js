import React, {useEffect, useState} from 'react';
import {Button, ButtonGroup, Card, Col, Nav, Row, ToggleButton, ToggleButtonGroup} from "react-bootstrap";

export default function TimeLine(props) {
  const [selectedTweetsMode, setSelectedTweetsMode] = useState('all');
  const handleFollowClick = (tweet) => {
    const params = {
      followUserId: tweet.user_id,
    }
    axios.post('follows', params)
      .then(res => {
        props.doFollow(tweet, res.data.follow);
      })
      .catch();
  };
  const handleRemoveClick = (tweet) => {
    const params = {
      followId: tweet.follow_id,
    };
    axios.delete('follows', {
      data: params
    })
      .then(() => {
        props.removeFollow(tweet);
      })
      .catch();
  };
  const handleFavoriteClick = (tweet) => {
    const params = {
      tweetId: tweet.id,
      userId: _loginUser.id,
    }
    axios.post('favorites', params)
      .then(res => {
        props.doFavorite(tweet, res.data.favorite);
      })
      .catch();
  };

  const handleRemoveFavoriteClick = (tweet) => {
    axios.delete('favorites/' + tweet.favorite_id)
      .then(res => {
        props.removeFavorite(tweet);
      })
      .catch(error => {
        console.error(error);
      });

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
      {props.tweets.map(t => {
        return(
          <Row key={t.id} style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', borderTop: 'none' }}>
            <Col>
              <h3>{t.name}</h3>
              <div>{t.tweet}</div>
              <div style={{paddingTop: '5px'}}>
                {(t.user_id !== _loginUser.id) && t.favorite_id == null &&
                  <Button
                    size="sm"
                    style={{ marginRight: '5px'}}
                    onClick={() => handleFavoriteClick(t)}
                  >お気に入りに登録する</Button>
                }
                {(t.user_id !== _loginUser.id) && t.favorite_id != null &&
                  <Button
                    size="sm"
                    variant="outline-danger"
                    style={{ marginRight: '5px'}}
                    onClick={() => handleRemoveFavoriteClick(t)}
                  >お気に入りを解除する</Button>
                }
                {(t.user_id !== _loginUser.id) && t.follow_id == null &&
                  <Button
                    size="sm"
                    onClick={() => handleFollowClick(t)}
                  >フォローする</Button>
                }
                {(t.user_id !== _loginUser.id) && t.follow_id != null &&
                  <Button
                    size="sm"
                    variant="outline-danger"
                    onClick={() => handleRemoveClick(t)}
                  >フォロー解除する</Button>
                }
              </div>
            </Col>
          </Row>
        );
      })}
    </>
  );

}

