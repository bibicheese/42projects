/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/12/05 19:02:50 by jmondino          #+#    #+#             */
/*   Updated: 2018/12/12 18:48:04 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft/libft.h"
#include "get_next_line.h"
# include <sys/types.h>
# include <sys/stat.h>
# include <fcntl.h>
#include <unistd.h>
#include <stdio.h>

int		get_next_line(const int fd, char **line)
{
	char	buff[BUFF_SIZE + 1];
	char	*temp;
	int		ret;
	int		i;

	i = 0;
	while ((ret = read(fd, buff, BUFF_SIZE)))
		buff[ret] = '\0';
	while(buff[i] != '\n')
		i++;
	printf("temp = %s\n", buff);
	printf("sub = %s\n", ft_strsub(buff, 0, i));
	return (1);
}

int		main(int argc, char **argv)
{
	char *line;
	int fd = open(argv[1], O_RDONLY);

	get_next_line(fd, &line);
	return 0;
}
