import React from 'react';
import { Button, Col, Row } from 'react-bootstrap';

export default function Tweet(props) {
  const handleRemoveTweet = () => {
    if (window.confirm('本当にツイートを削除しますか？')) {
      props.handleRemoveTweet(props.tweet)
    }
  };
  return (
    <Row key={props.tweet.id} style={{ padding: '0.75em 1.25em', border: '1px solid rgba(0, 0, 0, 0.125)', borderTop: 'none', backgroundColor: 'white' }}>
      <Col>
        <h3><a href={"/users/" + props.tweet.user_id} style={{color: "black"}}>{props.tweet.name}</a></h3>
        <div>{props.tweet.tweet}</div>
        <div style={{paddingTop: '5px'}}>
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.favorite_id == null &&
            <Button
              size="sm"
              style={{ marginRight: '5px'}}
              onClick={() => props.handleFavorite(props.tweet)}
            >お気に入りに登録する</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.favorite_id != null &&
            <Button
              size="sm"
              variant="outline-danger"
              style={{ marginRight: '5px'}}
              onClick={() =>props.handleRemoveFavorite(props.tweet)}
            >お気に入りを解除する</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.follow_id == null &&
            <Button
              size="sm"
              onClick={() =>props.handleFollow(props.tweet)}
            >フォローする</Button>
          }
          {(props.tweet.user_id !== _loginUser.id) && props.tweet.follow_id != null &&
            <Button
              size="sm"
              variant="outline-danger"
              onClick={() => props.handleRemoveFollow(props.tweet)}
            >フォロー解除する</Button>
          }
          {props.tweet.user_id == _loginUser.id &&
            <Button
              size="sm"
              variant="danger"
              onClick={handleRemoveTweet}
            >ツイートを削除する</Button>
          }
        </div>
      </Col>
    </Row>
  );
}
