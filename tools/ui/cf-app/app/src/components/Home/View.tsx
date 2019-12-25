import { initializeIcons } from '@uifabric/icons';
import { Breadcrumb, Layout } from 'antd';
import { Fabric } from 'office-ui-fabric-react/lib/Fabric';
import * as React from 'react';
import styled from 'styled-components';
import { Rest } from '../../api/Rest';
import * as Api from '../../api2';
import { Configuration } from '../../api2';
import { IGlobalCommands, TopCommandBar } from '../../components/CommandBar';
import { DetailComponent } from '../../components/Detail/Detail';
import { MainNavigation } from './Navigation';
import { PropertiesComponent } from '../../components/Properties/Properties';
import { IServerMessageProps, IServerMessagesProps } from '../../components/ServerMessages';
import { Inject, Module } from '../../di';
import { DeviceService } from '../../services/DeviceService';
import { Socket } from '../../socket';
import { IContentHandler, IDefaultProps } from '../../types';
import { Route, RouteComponentProps } from 'react-router-dom';
import * as qs from 'query-string';
import './View.scss';
const { Footer, Content, Sider } = Layout;

const LayoutContainer = styled(Layout) `
  height: 100vh;
  overflow-y: hidden;
`;

const ContentContainer = styled.section`
  display: flex;
  background-color: white;
  width: 100%;
  min-width: 100%;
  height: 100%;
  max-height: 100%;
  overflow-y: hidden;
  overflow-x: auto;
  box-sizing: border-box;
`;

const ColumnContainer = styled.div`
  border-right: 1px solid #ccc;
  height: 100%;
  max-height: 100%;
  overflow-y: auto;
  overflow-x: hidden;
  min-width: 250px;
`;

const StyledSider = styled(Sider) `
  background-color: white;
  border-left: 1px solid #ccc;
  padding:8px;
`;

const StyledFooter = styled(Footer) `
  border-top: 1px solid #ccc;
  background-color: white;
`;

initializeIcons()

// tslint:disable-next-line:no-var-requires
const Dock = require('react-dock').default;

// tslint:disable-next-line:interface-name
export interface ISplitDropDownButtonState {
    isContextMenuShown: boolean;
}

export type IAppProps = IDefaultProps & {
    user: any;
    token: string;
    socket: Socket;
    selected: string;
    type?: string;
    menu?: any;
    showTopMenu?: boolean;
    showProperties?: boolean;
    breadcrumb?: boolean;
    routeProps?: RouteComponentProps<any>;
}

export interface IAppState {
    modalAction?: string;
}

@Module({

})
export class View extends React.Component<IAppProps, IAppState> implements IContentHandler, IGlobalCommands {
    public detail: DetailComponent | null;
    public properties: PropertiesComponent | null;
    public apiConfig: Configuration;
    @Inject socket: Socket;

    public deviceService: DeviceService;

    constructor(args) {
        super(args);
        this.deviceService = new DeviceService();
    }

    public onAction(path: string) {

    }

    public open(item: any): Promise<any> {
        (this.detail as DetailComponent).open(item.name);
        return new Promise<boolean>((resolve, reject) => {
            resolve(true);
        });
    }

    public async componentDidMount() {
        const s = await this.socket.connect();
        this.subscribeServerMessages();
    }
    public componentWillMount() {
        const props: IAppProps = this.props;
        this.apiConfig = new Api.Configuration({
            basePath: 'http://localhost:3010',
            apiKey: 'JWT ' + props.token
        });
        // hmr
        if (!window['cfsocket']) {
            this.socket = props.socket;
            window['cfsocket'] = this.socket
        } else {
            this.socket = window['cfsocket']
        }
        this.deviceService.init(this.socket, this.props.token, this.apiConfig);
    }

    detailProps: IServerMessagesProps = {
        messages: []
    };

    public subscribeServerMessages() {
        const socket = this.socket;
        // console.log('subscribeServerMessages ', this);
        const detail = this.detail;
        socket.on('onDeviceError', (data: any) => {
            const message: IServerMessageProps = {
                event: 'Connection error',
                data: data,
                error: 2,
                detail: ''
            }
            this.detailProps.messages.push(message);
            if (detail) {
                detail.setState({
                    serverMessages: this.detailProps.messages
                });
            } else {
                console.error('have no detail');
            }
        });
    }
    public defaultProperties(): IDefaultProps {
        return {
            socket: this.socket,
            apiConfig: this.apiConfig,
            handler: this,
            properties: () => this.properties,
            selectedId: this.props.selectedId,
            type: this.props.type,
            rest: new Rest(this.apiConfig),
            route: () => this.route,
            routeProps: this.props.routeProps,
            project: () => {
                return parseInt(qs.parse(this.props.routeProps.location.search).project, 10);
            }
        }
    }
    public route: Route;
    public render() {
        console.log('render home view', this);
        const handler = this;
        return <div>
            <Route ref={(ref) => { this.route = ref; }}
                render={({ history }) => (
                    <Fabric>
                        {this.props.showTopMenu !== false ? <TopCommandBar {...this.defaultProperties()} /> : ''}
                        <Layout>
                            <MainNavigation handler={handler} />
                            <Content style={{ height: '100%', minHeight: '800px' }}>
                                <Breadcrumb style={{ paddingLeft: '10px', margin: '16px 0' }}>
                                    <Breadcrumb.Item>Home</Breadcrumb.Item>
                                </Breadcrumb>

                                <DetailComponent
                                    defaultProps={this.defaultProperties()}
                                    views={this.props.type ? [this.props.type] : []}
                                    selectedId={this.props.type}
                                    serverMessages={[]}
                                    // tslint:disable-next-line:jsx-alignment
                                    ref={(ref) => this.detail = ref} />
                            </Content>
                        </Layout>
                    </Fabric>
                )}>
            </Route>
        </div >
    }
}