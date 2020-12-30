import React, { useEffect, useState } from 'react';
import { Card, Col, Container, Row } from 'react-bootstrap';
import Tweet from './Tweet';
import UserDetailCard from './UserDetailCard';

export default function UserDetail(props) {
  const [tweets, setTweets] = useState([]);
  useEffect(() => {
    axios.get('/timeline/' + _loginUser.id + '?type=user&user_id=' + props.user.id)
      .then(res => {
        console.log(res.data);
        setTweets(res.data)
      })
      .catch(error => console.error(error));
  }, []);
  const handleFollow = (tweet) => {
    const params = {
      followUserId: tweet.user_id,
    }
    axios.post('/follows', params)
      .then(res => {
        const newTweets = tweets.map(t => {
          if(t.user_id === tweet.user_id) {
            t.follow_id = res.data.follow.id;
          }
          return t;
        });
        setTweets(newTweets);
      })
      .catch();
  };
  const handleRemoveFollow = (tweet) => {
    const params = {
      followId: tweet.follow_id,
    };
    axios.delete('/follows/' + tweet.follow_id, {
      data: params
    })
      .then(() => {
        const newTweets = tweets.map(t => {
          if(t.user_id === tweet.user_id) {
            t.follow_id = null;
          }
          return t;
        });
        setTweets(newTweets);
      })
      .catch();
  };
  const handleFavorite = (tweet) => {
    const params = {
      tweetId: tweet.id,
      userId: _loginUser.id,
    }
    axios.post('/favorites', params)
      .then(res => {
        const newTweets = Object.assign([], tweets);
        const index = tweets.findIndex(t => t.id === tweet.id);
        newTweets[index].favorite_id = res.data.favorite.id
        setTweets(newTweets);
      })
      .catch();
  };
  const handleRemoveFavorite = (tweet) => {
    axios.delete('/favorites/' + tweet.favorite_id)
      .then(() => {
        const copiedTweets = Object.assign([], tweets);
        const tweetIndex = copiedTweets.findIndex(t => {
          return t.id === tweet.id;
        });
        copiedTweets[tweetIndex].favorite_id = null;
        setTweets(copiedTweets);
      })
      .catch(error => {
        console.error(error);
      });
  };
  return (
    <>
      <Container>
        <Row className="justify-content-center">
          <Col md="4">
            <UserDetailCard user={_loginUser}/>
          </Col>
          <Col md="8">
              <Row style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', backgroundColor: 'rgba(0, 0, 0, 0.03)' }}>
                <h3 style={{marginBottom: 0}}>{props.user.name}のツイート</h3>
              </Row>
              {tweets.map(t =>
                <Tweet
                  key={t.id}
                  tweet={t}
                  handleFollow={handleFollow}
                  handleRemoveFollow={handleRemoveFollow}
                  handleFavorite={handleFavorite}
                  handleRemoveFavorite={handleRemoveFavorite}
                />
              )}
          </Col>
        </Row>
      </Container>
    </>
  );
}