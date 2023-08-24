export interface Post {
    status: string;
    content: string;
    likes: number;
    user?: User;
    discussion?: Discussion;
    parent?: Post;
    posts?: Array<Post>;
}

export interface Date {
    human: string;
    string: string;
}

export interface Discussion {
    id: string;
    title: string;
    status: string;
    likes: number;
    views: number;
    topic?: Topic;
    user?: User;
    created: Date;
}

export interface Topic {
    id: string;
    title: string;
    slug: string;
    discussions: Discussion[];
}

export interface Provider {
    name?: string;
    id?: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    role: string;
    avatar: string;
    provider?: Provider;
    verified: Date;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    topics: Array<Topic>;
    trending: Array<Discussion>;
};
