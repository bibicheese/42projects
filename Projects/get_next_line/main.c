/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/15 16:09:36 by jmondino          #+#    #+#             */
/*   Updated: 2019/07/15 16:17:28 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdio.h>
#include "get_next_line.h"

int		main(int ac, char **av)
{
	char	*line;
	int fd = open(av[1], O_RDONLY);

	while (get_next_line(fd, &line))
	{
		printf("%s\n", line);
		free(line);
	}
}
