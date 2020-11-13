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
                <Button size="sm" style={{ marginRight: '5px'}}>お気に入りに登録</Button>
                {(t.user_id !== _loginUser.id) && t.follow_id == null &&
                  <Button
                    size="sm"
                    onClick={() => handleFollowClick(t)}
                  >フォローする</Button>
                }
                {(t.user_id !== _loginUser.id) && t.follow_id != null &&
                  <Button
                    size="sm"
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

